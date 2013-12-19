<?php

namespace Ebanx\Command;

class PrintHtml extends \Ebanx\Command\AbstractCommand
{
    /**
     * The HTTP method
     * @var string
     */
    protected $_method = 'GET';

    /**
     * The action URL address
     * @var string
     */
    protected $_action = 'boleto/printHTML';

    /**
     * The response type - HTML or JSON
     * @var string
     */
    protected $_responseType = 'HTML';

    /**
     * Validates the request parameters
     * @param Ebanx\Command\Validator $validator The validator instance
     * @return mixed
     * @throws InvalidArgumentException
     */
    protected function _validate($validator)
    {
        $validator->validatePresence('hash');
    }
}