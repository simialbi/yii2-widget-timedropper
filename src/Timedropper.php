<?php
/**
 * @package yii2-timedropper
 * @author Simon Karlen <simi.albi@gmail.com>
 */

namespace simialbi\yii2\timedropper;

use simialbi\yii2\helpers\FormatConverter;
use simialbi\yii2\widgets\InputWidget;
use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

class Timedropper extends InputWidget
{
    const ANIMATION_FADE_IN = 'fadeIn';
    const ANIMATION_DROP_DOWN = 'dropDown';

    /**
     * @var boolean Automatically change hour-minute or minute-hour on mouseup/touchend. (Default: false)
     */
    public $autoSwitch = false;
    /**
     * @var boolean Set time in 12-hour clock in which the 24 hours of the day are divided into two periods.
     * (Default: false)
     */
    public $meridians = false;
    /**
     * @var string A time format string that timeDropper expects existing values to be in and will write times out it.
     * (Default: yii application time format)
     */
    public $format;
    /**
     * @var boolean Enables time change using mousewheel. (Default: false)
     */
    public $mouseWheel = false;
    /**
     * @var string Animation Style to use when init timedropper. There are three available animation values:
     * [[ANIMATION_FADE_IN]] (default), [[ANIMATION_DROP_DOWN]].
     */
    public $initAnimation = self::ANIMATION_FADE_IN;
    /**
     * @var boolean Automatically set current time by default.(Default: true)
     * If set *false*, the input *value* attribute is considered as main time value.
     */
    public $setCurrentTime = true;

    /**
     * @var string Specify a color value for drop down accent color. Default: #0d6efd
     */
    public $primaryColor = '#0d6efd';
    /**
     * @var string Specify a color value for drop down text color. Default: #212529
     */
    public $textColor = '#212529';
    /**
     * @var string Specify a color value for drop down background color. Default: #FFFFFF
     */
    public $backgroundColor = '#FFFFFF';
    /**
     * @var string Specify a color value for drop down border color. Default: rgba(0, 0, 0, 0.15)
     */
    public $borderColor = 'rgba(0, 0, 0, 0.15)';

    /**
     * {@inheritDoc}
     * @throws \ReflectionException
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();

        $this->registerTranslations();
    }

    /**
     * {@inheritDoc}
     */
    public function run()
    {
        $this->clientOptions = $this->getClientOptions();

        $this->registerPlugin('timeDropper');

        return ($this->hasModel())
            ? Html::activeInput('text', $this->model, $this->attribute, $this->options)
            : Html::input($this->name, $this->value, $this->options);
    }

    /**
     * Get client options
     *
     * @return array
     */
    protected function getClientOptions()
    {
        $format = ArrayHelper::remove(
            $this->clientOptions,
            'format',
            FormatConverter::convertDatePhpToIcu(FormatConverter::convertDateIcuToPhp(Yii::$app->formatter->timeFormat))
        );

        return ArrayHelper::merge($this->clientOptions, [
            'autoswitch' => $this->autoSwitch,
            'meridians' => $this->meridians,
            'format' => $format,
            'mousewheel' => $this->mouseWheel,
            'init_animation' => $this->initAnimation,
            'setCurrentTime' => $this->setCurrentTime,
            'primaryColor' => $this->primaryColor,
            'textColor' => $this->textColor,
            'backgroundColor' => $this->backgroundColor,
            'borderColor' => $this->borderColor
        ]);
    }
}