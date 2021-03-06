<?php namespace Anomaly\SelectFieldType;

use Anomaly\Streams\Platform\Addon\FieldType\FieldTypePresenter;

/**
 * Class SelectFieldTypePresenter
 *
 * @link          http://pyrocms.com/
 * @author        PyroCMS, Inc. <support@pyrocms.com>
 * @author        Ryan Thompson <ryan@pyrocms.com>
 */
class SelectFieldTypePresenter extends FieldTypePresenter
{

    /**
     * The decorated object.
     * This is for IDE support.
     *
     * @var SelectFieldType
     */
    protected $object;

    /**
     * Return the selection key.
     *
     * @return string|null
     */
    public function key()
    {
        return $this->object->getValue();
    }

    /**
     * Return the selection value.
     *
     * @return string|null
     */
    public function value()
    {
        $options = $this->object->getOptions();

        if (($key = $this->object->getValue()) === null) {
            return null;
        }

        if (!str_contains($value = array_get($options, $key), '::')) {
            return $value;
        }

        return trans($value);
    }

    /**
     * Return the currency symbol.
     *
     * @return string|null
     */
    public function symbol()
    {
        if (($key = $this->object->getValue()) === null) {
            return null;
        }

        return config('streams::currencies.supported.' . $key . '.symbol');
    }
}
