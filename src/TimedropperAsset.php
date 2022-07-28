<?php
/**
 * @package yii2-timedropper
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\timedropper;

use simialbi\yii2\web\AssetBundle;

/**
 * Asset bundle for datedropper Widget
 *
 * @author Simon karlen <simi.albi@outlook.com>
 */
class TimedropperAsset extends AssetBundle
{
    /**
     * {@inheritDoc}
     */
    public $css = [
        'css/timedropper.css'
    ];

    /**
     * {@inheritDoc}
     */
    public $js = [
        'js/timedropper.js'
    ];

    /**
     * {@inheritDoc}
     */
    public $depends = [
        'yii\web\JqueryAsset'
    ];
}
