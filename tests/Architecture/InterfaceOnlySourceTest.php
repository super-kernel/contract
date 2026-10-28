<?php

declare(strict_types=1);

namespace SuperKernel\Contract\Tests\Architecture;

use FilesystemIterator;
use PHPUnit\Framework\TestCase;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionClass;
use Throwable;

use function dirname;
use function file_get_contents;
use function interface_exists;
use function is_array;
use function sprintf;
use function token_get_all;

use const T_CLASS;
use const T_ENUM;
use const T_INTERFACE;
use const T_TRAIT;

final class InterfaceOnlySourceTest extends TestCase
{
    /** @throws Throwable When fixture setup or the operation under test throws */
    public function testProductionInterfacesUseFlatContractNamespace(): void
    {
        $source = dirname(__DIR__, 2) . '/src';
        $iterator = new FilesystemIterator($source, FilesystemIterator::SKIP_DOTS);

        foreach ($iterator as $file) {
            $this->assertTrue(
                $file->isFile() && 'php' === $file->getExtension(),
                sprintf('%s must contain production interface files directly.', $source),
            );

            $interface = sprintf('SuperKernel\\Contract\\%s', $file->getBasename('.php'));
            $this->assertTrue(interface_exists($interface), sprintf('%s must be autoloadable.', $interface));

            $contract = new ReflectionClass($interface);
            $this->assertSame($file->getRealPath(), $contract->getFileName());
        }
    }

    public function testProductionSourceDeclaresInterfacesOnly(): void
    {
        $source = dirname(__DIR__, 2) . '/src';
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($source, FilesystemIterator::SKIP_DOTS),
        );

        foreach ($iterator as $file) {
            if (!$file->isFile() || 'php' !== $file->getExtension()) {
                continue;
            }

            $contents = file_get_contents($file->getPathname());
            $this->assertNotFalse($contents, sprintf('Unable to read %s.', $file->getPathname()));
            $declarations = [];

            foreach (token_get_all($contents) as $token) {
                if (!is_array($token)) {
                    continue;
                }

                if (T_INTERFACE === $token[0]) {
                    $declarations[] = 'interface';
                } elseif (T_CLASS === $token[0]) {
                    $declarations[] = 'class';
                } elseif (T_TRAIT === $token[0]) {
                    $declarations[] = 'trait';
                } elseif (T_ENUM === $token[0]) {
                    $declarations[] = 'enum';
                }
            }

            $this->assertSame(
                [
                    'interface',
                ],
                $declarations,
                sprintf('%s must declare exactly one interface.', $file->getPathname()),
            );
        }
    }

    public function testProductionContractsDoNotReferenceAnnotatorModels(): void
    {
        $source = dirname(__DIR__, 2) . '/src';

        foreach (new FilesystemIterator($source, FilesystemIterator::SKIP_DOTS) as $file) {
            $contents = file_get_contents($file->getPathname());
            self::assertNotFalse($contents);
            self::assertStringNotContainsString('SuperKernel\\Annotator\\', $contents, $file->getFilename());
        }
    }

    /** @throws Throwable When fixture setup or the operation under test throws */
    public function testProductionInterfacesAndDeclaredMethodsHavePhpDocDescriptions(): void
    {
        $source = dirname(__DIR__, 2) . '/src';
        $iterator = new FilesystemIterator($source, FilesystemIterator::SKIP_DOTS);

        foreach ($iterator as $file) {
            $interface = sprintf('SuperKernel\\Contract\\%s', $file->getBasename('.php'));
            $contract = new ReflectionClass($interface);

            $this->assertHasPhpDocDescription($contract->getDocComment(), $interface);

            foreach ($contract->getMethods() as $method) {
                if ($interface !== $method->getDeclaringClass()->getName()) {
                    continue;
                }

                $this->assertHasPhpDocDescription(
                    $method->getDocComment(),
                    sprintf('%s::%s()', $interface, $method->getName()),
                );
            }
        }
    }

    private function assertHasPhpDocDescription(string|false $documentation, string $symbol): void
    {
        $this->assertIsString($documentation, sprintf('%s must declare PHPDoc.', $symbol));
        $this->assertMatchesRegularExpression(
            '/^\s*\*\s+(?!@)\S.+$/m',
            $documentation,
            sprintf('%s PHPDoc must include a description.', $symbol),
        );
    }
}
