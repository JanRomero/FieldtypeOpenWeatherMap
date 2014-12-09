<?php
class FieldtypeOpenWeatherMapConfig extends ModuleConfig
{
    public function getDefaults()
    {
        return array();
    }

    public function getInputfields()
    {
        $inputfields = parent::getInputfields();


        $f = $this->modules->get('InputfieldText');
        $f->attr('name', 'APIKey');
        $f->set('value', $this->APIKey);
        $f->label = $this->_('API Key');
        $f->description = $this->_("Your API key for the OpenWeatherMap service.");
        $f->attr('icon', 'key');
        $inputfields->add($f);


        $set = $this->modules->get('InputfieldFieldset');
        $set->attr('name', 'icons');
        $set->label = $this->_('Icon Markup');
        $set->description = $this->_("You can specify markup here and output it with **->renderIcon()**. \nFor example, if you use an icon font you may want to define span elements here that you style in your CSS, such as <span class='ico-Sunny'></span>. \nIf you wish to show the same markup for day and night, you may leave either one blank and the corresponding value will be used. If neither day not night are filled, an empty string is returned. \nOf course you may alternatively handle the **->iconcode** property template-side. For an overview of the icon codes available, see [OpenWeatherMap’s Weather Conditions](http://www.openweathermap.org/weather-conditions).");
        $set->attr('icon', 'cloud');

            $icodes = array('01d' => $this->_('Clear sky'),
                            '02d' => $this->_('Few clouds'),
                            '03d' => $this->_('Scattered clouds'),
                            '04d' => $this->_('Broken clouds'),
                            '09d' => $this->_('Shower rain'),
                            '10d' => $this->_('Rain'),
                            '11d' => $this->_('Thunderstorm'),
                            '13d' => $this->_('Snow'),
                            '50d' => $this->_('Mist'),
                            '01n' => $this->_('Clear sky, Night'),
                            '02n' => $this->_('Few clouds, Night'),
                            '03n' => $this->_('Scattered clouds, Night'),
                            '04n' => $this->_('Broken clouds, Night'),
                            '09n' => $this->_('Shower rain, Night'),
                            '10n' => $this->_('Rain, Night'),
                            '11n' => $this->_('Thunderstorm, Night'),
                            '13n' => $this->_('Snow, Night'),
                            '50n' => $this->_('Mist, Night'));

            $i = -1; //Fix for ProcessWire’s column widths, starting at -1 so the wide column will be the middle one ¯\(ツ)/¯
            foreach ($icodes as $code => $label)
            {
                $f = $this->modules->get('InputfieldText');
                $f->attr('name', $code);
                $f->set('value', $this->get($code));
                $f->label = $label;
                $f->placeholder = $code;
                $f->columnWidth = ($i % 3 === 0) ? 34 : 33;
                $set->add($f);
                $i++;
            }

        $inputfields->add($set);

        return $inputfields;
    }
}
