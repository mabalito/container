<?php
declare(strict_types=1);

namespace Jp\Container;

use Dice\Dice;
use Exception;
use Psr\Container\ContainerInterface;

class DiceContainer implements ContainerInterface
{
    /** @var Dice $dice */
    protected $dice;

    /**
     * Constructor.
     *
     * @param Dice $dice
     */
    public function __construct(Dice $dice)
    {
        $this->dice = $dice;
    }

    /**
     * Get the Dice object.
     *
     * @return Dice
     */
    public function dice() : Dice
    {
        return $this->dice;
    }

    /**
     * Finds an entry of the container by its identifier and returns it.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @throws NotFoundException No entry was found for **this** identifier.
     * @throws ContainerException Error while retrieving the entry.
     *
     * @return mixed Entry.
     */
    public function get($id)
    {
        if (!$this->has($id)) {
            throw new NotFoundException();
        }

        try {
            return $this->dice->create($id);
        } catch (Exception $e) {
            throw new ContainerException();
        }
    }

    /**
     * Returns true if the container can return an entry for the given
     * identifier. Returns false otherwise.
     *
     * `has($id)` returning true does not mean that `get($id)` will not throw an
     * exception. It does however mean that `get($id)` will not throw a
     * `NotFoundException`.
     *
     * @param string $id Identifier of the entry to look for.
     *
     * @return bool
     */
    public function has($id) : bool
    {
        return class_exists($id)
            || $this->dice->getRule($id) !== $this->dice->getRule('*')
        ;
    }
}
