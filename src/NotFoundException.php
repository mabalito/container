<?php
declare(strict_types=1);

namespace Jp\Container;

use Psr\Container\NotFoundExceptionInterface;

/**
 * No entry was found in the container.
 */
class NotFoundException extends ContainerException implements NotFoundExceptionInterface
{
}
