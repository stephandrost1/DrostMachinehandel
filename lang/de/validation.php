<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Der :attribute muss akzeptiert werden.',
    'accepted_if' => 'Der :attribute muss akzeptiert werden, wenn :other :value ist.',
    'active_url' => 'Die :attribute ist keine gültige URL.',
    'after' => 'Das :attribute muss ein Datum nach dem :date sein.',
    'after_or_equal' => 'Das :attribute muss ein Datum nach oder gleich dem :date sein.',
    'alpha' => 'Das :attribute darf nur Buchstaben enthalten.',
    'alpha_dash' => 'Das :attribute darf nur Buchstaben, Zahlen, Bindestriche und Unterstriche enthalten.',
    'alpha_num' => 'Das :attribute darf nur Buchstaben und Zahlen enthalten.',
    'array' => 'Das :attribute muss ein Array sein.',
    'before' => 'Das :attribute muss ein Datum vor dem :date sein.',
    'before_or_equal' => 'Das :attribute muss ein Datum vor oder gleich dem :date sein.',
    'between' => [
        'array' => 'Das :attribute muss zwischen :min und :max Elemente haben.',
        'file' => 'Das :attribute muss zwischen :min und :max Kilobytes groß sein.',
        'numeric' => 'Das :attribute muss zwischen :min und :max liegen.',
        'string' => 'Das :attribute muss zwischen :min und :max Zeichen lang sein.',
    ],
    'boolean' => 'Das :attribute-Feld muss true oder false sein.',
    'confirmed' => 'Die Bestätigung für :attribute stimmt nicht überein.',
    'current_password' => 'Das Passwort ist falsch.',
    'date' => 'Das :attribute ist kein gültiges Datum.',
    'date_equals' => 'Das :attribute muss ein Datum gleich dem :date sein.',
    'date_format' => 'Das :attribute entspricht nicht dem Format :format.',
    'declined' => 'Der :attribute muss abgelehnt werden.',
    'declined_if' => 'Der :attribute muss abgelehnt werden, wenn :other :value ist.',
    'different' => 'Das :attribute und :other müssen unterschiedlich sein.',
    'digits' => 'Das :attribute muss :digits Stellen haben.',
    'digits_between' => 'Das :attribute muss zwischen :min und :max Stellen haben.',
    'dimensions' => 'Das :attribute hat ungültige Bildabmessungen.',
    'distinct' => 'Das :attribute-Feld hat einen doppelten Wert.',
    'doesnt_start_with' => 'Das :attribute darf nicht mit einem der folgenden beginnen: :values.',
    'email' => 'Die :attribute muss eine gültige E-Mail-Adresse sein.',
    'ends_with' => 'Die :attribute muss mit einem der folgenden enden: :values.',
    'enum' => 'Die ausgewählte :attribute ist ungültig.',
    'exists' => 'Die ausgewählte :attribute ist ungültig.',
    'file' => 'Die :attribute muss eine Datei sein.',
    'filled' => 'Das :attribute-Feld muss ausgefüllt sein.',
    'gt' => [
        'array' => 'Die :attribute muss mehr als :value Elemente haben.',
        'file' => 'Die :attribute muss größer als :value Kilobytes sein.',
        'numeric' => 'Die :attribute muss größer als :value sein.',
        'string' => 'Die :attribute muss länger als :value Zeichen sein.',
    ],
    'gte' => [
        'array' => 'Die :attribute muss :value oder mehr Elemente haben.',
        'file' => 'Die :attribute muss größer oder gleich :value Kilobytes sein.',
        'numeric' => 'Die :attribute muss größer oder gleich :value sein.',
        'string' => 'Die :attribute muss länger oder gleich :value Zeichen sein.',
    ],
    'image' => 'Die :attribute muss ein Bild sein.',
    'in' => 'Die ausgewählte :attribute ist ungültig.',
    'in_array' => 'Das :attribute-Feld existiert nicht in :other.',
    'integer' => 'Die :attribute muss eine Ganzzahl sein.',
    'ip' => 'Die :attribute muss eine gültige IP-Adresse sein.',
    'ipv4' => 'Die :attribute muss eine gültige IPv4-Adresse sein.',
    'ipv6' => 'Die :attribute muss eine gültige IPv6-Adresse sein.',
    'json' => 'Die :attribute muss eine gültige JSON-Zeichenfolge sein.',
    'lt' => [
        'array' => 'Die :attribute darf nicht mehr als :value Elemente haben.',
        'file' => 'Die :attribute muss kleiner als :value Kilobytes sein.',
        'numeric' => 'Die :attribute muss kleiner als :value sein.',
        'string' => 'Die :attribute muss kürzer als :value Zeichen sein.',
    ],
    'lte' => [
        'array' => 'Die :attribute darf nicht mehr als :value Elemente haben.',
        'file' => 'Die :attribute muss kleiner oder gleich :value Kilobytes sein.',
        'numeric' => 'Die :attribute muss kleiner oder gleich :value sein.',
        'string' => 'Die :attribute muss kürzer oder gleich :value Zeichen sein.',
    ],
    'mac_address' => 'Die :attribute muss eine gültige MAC-Adresse sein.',
    'max' => [
        'array' => 'Die :attribute darf nicht mehr als :max Elemente haben.',
        'file' => 'Die :attribute darf nicht größer als :max Kilobytes sein.',
        'numeric' => 'Die :attribute darf nicht größer als :max sein.',
        'string' => 'Die :attribute darf nicht länger als :max Zeichen sein.',
    ],
    'mimes' => 'Die :attribute muss eine Datei vom Typ :values sein.',
    'mimetypes' => 'Die :attribute muss eine Datei vom Typ :values sein.',
    'min' => [
        'array' => 'Die :attribute muss mindestens :min Elemente haben.',
        'file' => 'Die :attribute muss mindestens :min Kilobytes groß sein.',
        'numeric' => 'Die :attribute muss mindestens :min betragen.',
        'string' => 'Die :attribute muss mindestens :min Zeichen lang sein.',
    ],
    'multiple_of' => 'Die :attribute muss ein Vielfaches von :value sein.',
    'not_in' => 'Die ausgewählte :attribute ist ungültig.',
    'not_regex' => 'Das :attribute-Format ist ungültig.',
    'numeric' => 'Die :attribute muss eine Zahl sein.',
    'password' => [
        'letters' => 'Die :attribute muss mindestens einen Buchstaben enthalten.',
        'mixed' => 'Die :attribute muss mindestens einen Kleinbuchstaben und einen Großbuchstaben enthalten.',
        'numbers' => 'Die :attribute muss mindestens eine Zahl enthalten.',
        'symbols' => 'Die :attribute muss mindestens ein Symbol enthalten.',
        'uncompromised' => 'Die angegebene :attribute ist in einem Datenleck aufgetaucht. Bitte wähle eine andere :attribute.',
    ],
    'present' => 'Das Feld :attribute muss vorhanden sein.',
    'prohibited' => 'Das Feld :attribute ist verboten.',
    'prohibited_if' => 'Das Feld :attribute ist verboten, wenn :other :value ist.',
    'prohibited_unless' => 'Das Feld :attribute ist verboten, es sei denn :other ist in :values.',
    'prohibits' => 'Das Feld :attribute verbietet die Anwesenheit von :other.',
    'regex' => 'Das Format des Feldes :attribute ist ungültig.',
    'required' => 'Das Feld :attribute ist erforderlich.',
    'required_array_keys' => 'Das Feld :attribute muss Einträge für folgende enthalten: :values.',
    'required_if' => 'Das Feld :attribute ist erforderlich, wenn :other :value ist.',
    'required_unless' => 'Das Feld :attribute ist erforderlich, es sei denn :other ist in :values.',
    'required_with' => 'Das Feld :attribute ist erforderlich, wenn :values vorhanden ist.',
    'required_with_all' => 'Das Feld :attribute ist erforderlich, wenn :values vorhanden sind.',
    'required_without' => 'Das Feld :attribute ist erforderlich, wenn :values nicht vorhanden ist.',
    'required_without_all' => 'Das Feld :attribute ist erforderlich, wenn keines von :values vorhanden ist.',
    'same' => ':attribute und :other müssen übereinstimmen.',
    'size' => [
        'array' => ':attribute muss :size Elemente enthalten.',
        'file' => ':attribute muss :size Kilobyte groß sein.',
        'numeric' => ':attribute muss :size sein.',
        'string' => ':attribute muss :size Zeichen enthalten.',
    ],
    'starts_with' => ':attribute muss mit einem der folgenden beginnen: :values.',
    'string' => ':attribute muss eine Zeichenfolge sein.',
    'timezone' => ':attribute muss eine gültige Zeitzone sein.',
    'unique' => ':attribute wurde bereits vergeben.',
    'uploaded' => ':attribute konnte nicht hochgeladen werden.',
    'url' => ':attribute muss eine gültige URL sein.',
    'uuid' => ':attribute muss eine gültige UUID sein.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
