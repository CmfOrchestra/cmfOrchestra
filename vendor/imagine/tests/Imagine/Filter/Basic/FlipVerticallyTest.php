<?php

/*
 * This file is part of the Imagine package.
 *
 * (c) Bulat Shakirzyanov <mallluhuct@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Imagine\Filter\Basic;

use Imagine\Filter\FilterTestCase;

class FlipVerticallyTest extends FilterTestCase
{
    public function testShouldFlipImage()
    {
        $image  = $this->getImage();
        $filter = new FlipVertically();

        $image->expects($this->once())
            ->method('flipVertically')
            ->will($this->returnValue($image));

        $this->assertSame($image, $filter->apply($image));
    }
}
