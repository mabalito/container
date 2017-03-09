<?php
declare(strict_types=1);

namespace Jp\Container;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Base interface representing a generic exception in a container.
 */
class ContainerException extends Exception implements ContainerExceptionInterface
{
}
