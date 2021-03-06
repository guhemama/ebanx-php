<?php
/**
 * Copyright (c) 2013, EBANX Tecnologia da Informação Ltda.
 *  All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *
 * Redistributions of source code must retain the above copyright notice, this
 * list of conditions and the following disclaimer.
 *
 * Redistributions in binary form must reproduce the above copyright notice,
 * this list of conditions and the following disclaimer in the documentation
 * and/or other materials provided with the distribution.
 *
 * Neither the name of EBANX nor the names of its
 * contributors may be used to endorse or promote products derived from
 * this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDER OR CONTRIBUTORS BE LIABLE
 * FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL
 * DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR
 * SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY,
 * OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

class RefundOrCancelTest extends TestCase
{
    protected $_params;

    public function setUp()
    {
        parent::setUp();

        $this->_params = array(
            'hash'        => md5(time())
          , 'description' => 'Lorem ipsum dolor sit amet.'
        );
    }

    public function testValidateHash()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'hash' was not supplied.");
        unset($this->_params['hash']);
        \Ebanx\Ebanx::doRefundOrCancel($this->_params);
    }

    public function testValidateDescription()
    {
        $this->setExpectedException('InvalidArgumentException', "The parameter 'description' was not supplied.");
        unset($this->_params['description']);
        \Ebanx\Ebanx::doRefundOrCancel($this->_params);
    }

    public function testRequest()
    {
        $request = \Ebanx\Ebanx::doRefundOrCancel($this->_params);

        $this->assertEquals('POST', $request['method']);
        $this->assertEquals('https://www.ebanx.com/pay/ws/refundOrCancel', $request['action']);
        $this->assertEquals(true, $request['decode']);
        $this->assertEquals($this->_params['hash'], $request['params']['hash']);
        $this->assertEquals($this->_params['description'], $request['params']['description']);
    }
}