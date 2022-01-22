<?php

namespace App\Http\Tools;

class HTML5Renderer
{
    public function input($name, $properties)
    {
        switch ($properties['type']) {
            case 'currency':

                $html = '
                <label class="form-check-label" for="' . $name . '">' . $properties['title'] . '</label>
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">$COP</span>
                        </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" name="' . $name . '" value="' . $properties['value'] . '">
                        <div class="input-group-append">
                            <span class="input-group-text">.00</span>
                        </div>
                </div>';

                return $html;
            case 'select':
                $array = $properties['values'];
                $options = '';
                foreach ($array as $value => $content) {
                    $options .= '<option value="' . $value . '">' . $content . '</option>';
                }
                $html = '
                <div class="form-group">
                    <label for="' . $name . '">' . __($properties['title']) . '</label>
                    <select name="' . $name . '">
                    ' . $options . '
                    </select>
                </div>';

                return $html;
            case 'submit':
                return '<input type="hidden" name="submit" value="1">';
            case 'radios':
                $array = $properties['values'];
                $options = '';
                foreach ($array as $value => $content) {
                    $options .= '
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="' . $name . '" value="' . $value . '" ' . ((isset($array['checked']) && $array['checked'] = $value) ? 'checked' : '') . '>
                        <label class="form-check-label" for="' . $value . '">' . $content . '</label>
                    </div>';
                }
                $html = '
                <div class="form-check">
                <label for="' . $name . '">' . __($properties['title']) . '</label>
                ' . $options . '
                </div>';

                return $html;
            default:
                $html = '
                        <div class="form-group">
                            <label for="' . $name . '" class="mt-3">' . __($properties['title']) . '</label>
                            <input class="form-control" name="' . $name . '" type="' . $properties['type'] . '" value="' . $properties['value'] . '" placeholder="' . __($properties['placeholder']) . '">
                        </div>';
                return $html;
        }
    }
}
