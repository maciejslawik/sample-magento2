<?php
/**
 * File: registration.php
 *
 * @author      Maciej Sławik <maciekslawik@gmail.com>
 * Github       https://github.com/maciejslawik
 */

//This registers the module in autoloading
\Magento\Framework\Component\ComponentRegistrar::register(
    \Magento\Framework\Component\ComponentRegistrar::MODULE,
    'MSlwk_Sample',
    __DIR__
);
