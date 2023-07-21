<?php

//SLUGGABLE WORDS

use Illuminate\Support\Str;

if (! function_exists('getReadable')) {
    function getReadable($text)
    {
        return ucwords(str_replace('_', ' ', $text));
    }
}

//DATATABLE BUTTONS
if (! function_exists('dtViewButton')) {
    function dtViewButton($url)
    {
        return view(
            'backend.theme.components.buttons.view',
            ['url' => $url]
        );
    }
}
if (! function_exists('dtEditButton')) {
    function dtEditButton($url)
    {
        return view(
            'backend.theme.components.buttons.edit',
            ['url' => $url]
        );
    }
}
if (! function_exists('dtDeleteButton')) {
    function dtDeleteButton($url)
    {
        return view(
            'backend.theme.components.buttons.delete',
            ['url' => serialize($url)]
        );
    }
}

if (! function_exists('dtRestoreButton')) {
    function dtRestoreButton($url)
    {
        return view(
            'backend.theme.components.buttons.restore',
            ['url' => serialize($url)]
        );
    }
}

if (! function_exists('dtEmailButton')) {
    function dtEmailButton($url)
    {
        return view(
            'backend.theme.components.buttons.email',
            ['url' => serialize($url)]
        );
    }
}
//---------- END DATATABLE BUTTONS

if (! function_exists('saveButton')) {
    function saveButton($text = null, $ajaxSubmit = true)
    {
        return view(
            'backend.theme.components.buttons.form.save',
            [
                'text' => $text,
                'ajaxSubmit' => $ajaxSubmit,
            ]
        );
    }
}

if (! function_exists('updateButton')) {
    function updateButton($text = null, $ajaxSubmit = true)
    {
        return view(
            'backend.theme.components.buttons.form.update',
            [
                'text' => $text,
                'ajaxSubmit' => $ajaxSubmit,
            ]
        );
    }
}

if (!function_exists('syncButton')) {
    function syncButton($text = null, $ajaxSubmit = true)
    {
        return view(
            'backend.theme.components.buttons.form.sync',
            [
                'text' => $text,
                'ajaxSubmit' => $ajaxSubmit,
            ]
        );
    }
}

if (! function_exists('deleteButton')) {
    function deleteButton($url)
    {
        return view(
            'backend.theme.components.buttons.form.delete',
            ['url' => serialize($url)]
        );
    }
}

if (! function_exists('resetButton')) {
    function resetButton($text = null)
    {
        return view(
            'backend.theme.components.buttons.form.reset',
            ['text' => $text]
        );
    }
}

if (! function_exists('backButton')) {
    function backButton($text = null)
    {
        return view(
            'backend.theme.components.buttons.form.back',
            ['text' => $text]
        );
    }
}

if (! function_exists('errorMessage')) {
    function errorMessage($errors, string $field)
    {
        if ($errors->has($field)) {
            return ' <div id="val-error'.$field.'" class="invalid-feedback animated fadeIn">'.$errors->first($field).'</div>';
        }

        return null;
    }
}

if (! function_exists('errorMessageAjax')) {
    function errorMessageAjax(string $field)
    {
        if (is_string($field)) {
            return '<p class="text-danger error '.str_replace('.', '_', $field).'"></p>';
        }

        return null;
    }
}

if (! function_exists('errorClass')) {
    function errorClass($errors, string $field)
    {
        if ($errors->has($field)) {
            return 'is-invalid';
        }

        return null;
    }
}

if (! function_exists('getTranslation')) {
    function getTranslation($model, $locale = 'en', $column = 'name')
    {
        if ($model) {
            return $model->translate($column, $locale);
        }

        return null;
    }
}

if (! function_exists('withDefaults')) {
    function withDefaults($records, $message = '- Please Select -')
    {
        if (is_array($records)) {
            //            return array_merge(['' => '- Please Select -'], $records);
            return ['' => $message] + $records;
        }

        return $records->prepend($message, '');
    }
}

if (! function_exists('transSelect')) {
    function transSelect($records, $column)
    {
        $result = [];
        foreach ($records as $record) {
            $result[$record->id] = $record->translate($column, 'en');
        }

        return withDefaults($result);
    }
}

if (! function_exists('getLocaleLabel')) {
    function getLocaleLabel($locale = 'en', $required = true)
    {
        $localeLabel = $required ? '*' : '';
        if (strcmp($locale, config('app.locale')) !== 0) {
            $localeLabel = "($locale)";
        }

        return $localeLabel;
    }
}

if (!function_exists('getImageSinglePreview')) {
    function getImageSinglePreview($media)
    {
        if (isset($media)) {
            $data['media'] = $media;

            return view('backend.theme.components.image-single-popup', $data)->render();
        }
    }
}

if (! function_exists('getImagePreview')) {
    function getImagePreview($model, $collection = 'null', $required = true)
    {
        if (isset($model) && ! $model->getMedia($collection)->isEmpty()) {
            $data['model'] = $model;
            $data['collection'] = $collection;
            $data['required'] = $required;

            return view('backend.theme.components.image-popup', $data)->render();
        }
    }
}

if (! function_exists('getFilePreview')) {
    function getFilePreview($model, $collection = 'null', $required = true)
    {
        if (isset($model) && ! $model->getMedia($collection)->isEmpty()) {
            $data['model'] = $model;
            $data['collection'] = $collection;
            $data['required'] = $required;

            return view('backend.theme.components.file-popup', $data)->render();
        }
    }
}

if (! function_exists('cleanURL')) {
    function cleanURL($string, $delimiter = '-')
    {
        return preg_replace('/\s+/u', $delimiter, trim($string));
    }
}

if (! function_exists('readDuration')) {
    function readDuration($body)
    {
        $totalWords = Str::wordCount(strip_tags($body));
        $minutesToRead = round($totalWords / 200);

        return (int) max(1, $minutesToRead);
    }
}

if (!function_exists('serviceSVGIcons')) {
    function serviceSVGIcons()
    {

        return view('frontend.home.includes.servicesSVG');
    }
}
