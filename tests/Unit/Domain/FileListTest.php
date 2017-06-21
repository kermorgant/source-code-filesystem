<?php

namespace DTL\Filesystem\Tests\Unit\Domain;

use PHPUnit\Framework\TestCase;
use DTL\Filesystem\Domain\FileList;
use DTL\Filesystem\Domain\FilePath;

class FileListTest extends TestCase
{
    /**
     * @testdox It returns true if it contains a file path.
     */
    public function testContains()
    {
        $list = FileList::fromFilePaths([
            FilePath::fromPathInCurrentCwd('Foo/Bar.php'),
            FilePath::fromPathInCurrentCwd('Foo/Foo.php'),
        ]);

        $this->assertTrue($list->contains(FilePath::fromPathInCurrentCwd('Foo/Bar.php')));
    }

    /**
     * @testdox It returns files within a path
     */
    public function testWithin()
    {
        $list = FileList::fromFilePaths([
            FilePath::fromPathInCurrentCwd('Foo/Bar.php'),
            FilePath::fromPathInCurrentCwd('Foo/Foo.php'),
            FilePath::fromPathInCurrentCwd('Boo/Bar.php'),
            FilePath::fromPathInCurrentCwd('Foo.php'),
        ]);
        $expected = FileList::fromFilePaths([
            FilePath::fromPathInCurrentCwd('Foo/Bar.php'),
            FilePath::fromPathInCurrentCwd('Foo/Foo.php'),
        ]);

        $this->assertEquals(
            iterator_to_array($expected),
            iterator_to_array($list->within(FilePath::fromPathInCurrentCwd('Foo')))
        );

    }
}
