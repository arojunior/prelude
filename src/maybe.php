<?php

namespace Prelude;

const maybe = __NAMESPACE__.'\maybe';

/**
 * @param mixed $x
 *
 * @return MaybeInterface
 */
function maybe($x)
{
    return ifElse(isNull)
        ([Nothing::class, 'factory'])
        ([Just::class, 'factory'])
        ($x);
}

interface MaybeInterface
{
    /**
     * @param callable $fn
     *
     * @return MaybeInterface
     */
    public function bind(callable $fn);

    /**
     * The isJust function returns True iff its argument is of the form Just _.
     *
     * isJust :: Maybe a -> Bool
     */
    public function isJust();

    /**
     * The isNothing function returns True iff its argument is Nothing.
     *
     * isNothing :: Maybe a -> Bool
     */
    public function isNothing();

    /**
     * The fromJust function extracts the element out of a Just and throws an error if its argument is Nothing.
     *
     * fromJust :: Maybe a -> a
     */
    public function fromJust();

    /**
     * The fromMaybe function takes a default value and and Maybe value.
     * If the Maybe is Nothing, it returns the default values; otherwise,
     * it returns the value contained in the Maybe.
     *
     * fromMaybe :: a -> Maybe a -> a
     */
    public function fromMaybe($def);

    /**
     * The maybe function takes a default value, a function, and a Maybe value.
     * If the Maybe value is Nothing, the function returns the default value.
     * Otherwise, it applies the function to the value inside the Just and returns the result.
     *
     * maybe :: b -> (a -> b) -> Maybe a -> b
     */
    public function maybe($def, callable $fn);
}

final class Just implements MaybeInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @param mixed $value
     *
     * @return Just
     */
    public static function factory($value)
    {
        return new self($value);
    }

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function bind(callable $fn)
    {
        return maybe($fn($this->value));
    }

    /**
     * {@inheritdoc}
     */
    public function isJust()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function isNothing()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function fromJust()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function fromMaybe($def)
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     */
    public function maybe($def, callable $fn)
    {
        return $fn($this->value);
    }
}

final class Nothing implements MaybeInterface
{
    /**
     * @return Nothing
     */
    public static function factory()
    {
        return new self();
    }

    /**
     * {@inheritdoc}
     */
    public function bind(callable $fn)
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function isJust()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function isNothing()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function fromJust()
    {
        throw new \RuntimeException();
    }

    /**
     * {@inheritdoc}
     */
    public function fromMaybe($def)
    {
        return $def;
    }

    /**
     * {@inheritdoc}
     */
    public function maybe($def, callable $fn)
    {
        return $def;
    }
}
