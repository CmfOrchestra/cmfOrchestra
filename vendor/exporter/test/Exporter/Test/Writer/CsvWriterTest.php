<?php

namespace Exporter\Test\Source;

use Exporter\Writer\CsvWriter;

class CsvWriterTest extends \PHPUnit_Framework_TestCase
{
    protected $filename;

    public function setUp()
    {
        $this->filename = 'foobar.csv';

        if (is_file($this->filename)) {
            unlink($this->filename);
        }
    }

    /**
     * @expectedException \Exporter\Exception\InvalidDataFormatException
     */
    public function testInvalidDataFormat()
    {
        $writer = new CsvWriter($this->filename, ',', '', "\\", false);
        $writer->open();

        $writer->write(array('john "2', 'doe', '1'));
    }

    public function testEnclosureFormating()
    {

        $writer = new CsvWriter($this->filename, ',', '"', "\\", false);
        $writer->open();

        $writer->write(array(' john , ""2"', 'doe', '1'));

        $writer->close();

        $expected = '"john \, """"2""","doe","1"';

        $this->assertEquals($expected, trim(file_get_contents($this->filename)));
    }

    public function testEnclosureFormatingWithExcel()
    {
        $writer = new CsvWriter($this->filename, ',', '"', "", false);
        $writer->open();

        $writer->write(array('john , ""2"', 'doe ', '1'));

        $writer->close();

        $expected = '"john , """"2""","doe","1"';

        $this->assertEquals($expected, trim(file_get_contents($this->filename)));
    }

    public function testWithHeaders()
    {
        $writer = new CsvWriter($this->filename, ',', '"', "", true);
        $writer->open();

        $writer->write(array('name' => 'john , ""2"', 'surname' => 'doe ', 'year' => '2001'));

        $writer->close();

        $expected = 'name,surname,year'."\r\n".'"john , """"2""","doe","2001"';

        $this->assertEquals($expected, trim(file_get_contents($this->filename)));
    }

    public function tearDown()
    {
        unlink($this->filename);
    }
}
