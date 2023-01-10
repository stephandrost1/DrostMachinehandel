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

    'accepted' => ":Attribute doit être accepté.",
    'accepted_if' => ":Attribute doit être accepté lorsque :other est égal à :value.",
    'active_url' => ":Attribute n'est pas une URL valide.",
    'after' => ":Attribute doit être une date après :date.",
    'after_or_equal' => ":Attribute doit être une date après ou égale à :date.",
    'alpha' => ":Attribute ne peut contenir que des lettres.",
    'alpha_dash' => ":Attribute ne peut contenir que des lettres, des chiffres et des tirets.",
    'alpha_num' => ":Attribute ne peut contenir que des lettres et des chiffres.",
    'array' => ":Attribute doit être un tableau.",
    'before' => ":Attribute doit être une date avant :date.",
    'before_or_equal' => ":Attribute doit être une date avant ou égale à :date.",
    'between' => [
        'numeric' => ":Attribute doit être compris entre :min et :max.",
        'file' => ":Attribute doit avoir une taille comprise entre :min et :max kilobytes.",
        'string' => ":Attribute doit avoir une longueur comprise entre :min et :max caractères.",
        'array' => ":Attribute doit avoir entre :min et :max éléments.",
    ],
    'boolean' => "Le champ :attribute doit être vrai ou faux.",
    'confirmed' => "La confirmation de l'attribut :attribute ne correspond pas.",
    'current_password' => "Le mot de passe est incorrect.",
    'date' => "L'attribut :attribute n'est pas une date valide.",
    'date_equals' => "L'attribut :attribute doit être une date égale à :date.",
    'date_format' => "L'attribut :attribute ne correspond pas au format :format.",
    'declined' => "L'attribut :attribute doit être refusé.",
    'declined_if' => "L'attribut :attribute doit être refusé lorsque :other est :value.",
    'different' => "L'attribut :attribute et :other doivent être différents.",
    'digits' => "L'attribut :attribute doit être de :digits chiffres.",
    'digits_between' => "L'attribut :attribute doit être compris entre :min et :max chiffres.",
    'dimensions' => "L'attribut :attribute a des dimensions d'image non valides.",
    'distinct' => "Le champ :attribute a une valeur en double.",
    'doesnt_start_with' => "L'attribut :attribute ne peut pas commencer par l'un des éléments suivants : :values.",
    'email' => "L'attribut :attribute doit être une adresse email valide.",
    'ends_with' => "L'attribut :attribute doit finir par l'un des éléments suivants : :values.",
    'enum' => "L'attribut sélectionné :attribute n'est pas valide.",
    'exists' => "L'attribut sélectionné :attribute n'est pas valide.",
    'file' => "L'attribut :attribute doit être un fichier.",
    'filled' => "Le champ :attribute doit avoir une valeur.",
    'gt' => [
        'array' => "L'attribut :attribute doit avoir plus de :value éléments.",
        'file' => "L'attribut :attribute doit être supérieur à :value kilo-octets.",
        'numeric' => "L'attribut :attribute doit être supérieur à :value.",
        'string' => "L'attribut :attribute doit être supérieur à :value caractères.",
    ],
    'gte' => [
        'array' => "L'attribut :attribute doit avoir :value éléments ou plus.",
        'file' => "L'attribut :attribute doit être supérieur ou égal à :value kilo-octets.",
        'numeric' => "L'attribut :attribute doit être supérieur ou égal à :value.",
        'string' => "L'attribut :attribute doit être supérieur ou égal à :value caractères.",
    ],
    'image' => ":Attribute doit être une image.",
    'in' => "L'attribut sélectionné :attribute est invalide.",
    'in_array' => ":Attribute n'apparaît pas dans :other.",
    'integer' => ":Attribute doit être un entier.",
    'ip' => ":Attribute doit être une adresse IP valide.",
    'ipv4' => ":Attribute doit être une adresse IPv4 valide.",
    'ipv6' => ":Attribute doit être une adresse IPv6 valide.",
    'json' => ":Attribute doit être une chaîne JSON valide.",
    'lt' => [
        'numeric' => "Le champ :attribute doit être inférieur à :value.",
        'file' => "Le champ :attribute doit être inférieur à :value kilo-octets.",
        'string' => "Le champ :attribute doit être inférieur à :value caractères.",
        'array' => "Le champ :attribute doit contenir moins de :value éléments.",
    ],
    'lte' => [
        'numeric' => "Le champ :attribute doit être inférieur ou égal à :value.",
        'file' => "Le champ :attribute doit être inférieur ou égal à :value kilo-octets.",
        'string' => "Le champ :attribute doit être inférieur ou égal à :value caractères.",
        'array' => "Le champ :attribute ne peut pas contenir plus de :value éléments.",
    ],
    'mac_address' => ":Attribute doit être une adresse MAC valide.",
    'max' => [
        'numeric' => ":Attribute ne peut pas être supérieur à :max.",
        'file' => ":Attribute ne peut pas être supérieur à :max kilo-octets.",
        'string' => ":Attribute ne peut pas être supérieur à :max caractères.",
        'array' => ":Attribute ne peut pas contenir plus de :max éléments.",
    ],
    'mimes' => "Le fichier :attribute doit être de type :values.",
    'mimetypes' => "Le fichier :attribute doit être de type :values.",
    'min' => [
        'array' => "Le champ :attribute doit contenir au moins :min éléments.",
        'file' => "Le fichier :attribute doit faire au moins :min kilo-octets.",
        'numeric' => "Le champ :attribute doit être au moins :min.",
        'string' => "Le champ :attribute doit contenir au moins :min caractères.",
    ],
    'multiple_of' => "Le champ :attribute doit être un multiple de :value.",
    'not_in' => "Le champ :attribute sélectionné n'est pas valide.",
    'not_regex' => "Le format du champ :attribute n'est pas valide.",
    'numeric' => "Le champ :attribute doit être un nombre.",
    'password' => [
        'letters' => "Le champ :attribute doit contenir au moins une lettre.",
        'mixed' => "Le champ :attribute doit contenir au moins une lettre majuscule et une lettre minuscule.",
        'numbers' => "Le champ :attribute doit contenir au moins un chiffre.",
        'symbols' => "Le champ :attribute doit contenir au moins un symbole.",
        'uncompromised' => "Le champ :attribute donné a été publié dans une fuite de données. Veuillez en choisir un autre.",
    ],
    'present' => ":Attribute doit être présent.",
    'prohibited' => "Le champ :attribute n'est pas autorisé.",
    'prohibited_if' => "Le champ :attribute n'est pas autorisé lorsque :other est :value.",
    'prohibited_unless' => "Le champ :attribute n'est pas autorisé sauf si :other se trouve dans :values.",
    'prohibits' => "Le champ :attribute interdit la présence de :other.",
    'regex' => "Le format du champ :attribute est invalide.",
    'required' => "Le champ :attribute est obligatoire.",
    'required_array_keys' => "Le champ :attribute doit contenir les valeurs suivantes :values.",
    'required_if' => "Le champ :attribute est obligatoire lorsque :other est :value.",
    'required_unless' => "Le champ :attribute est obligatoire sauf si :other est présent dans :values.",
    'required_with' => "Le champ :attribute est obligatoire lorsque :values est présent.",
    'required_with_all' => "Le champ :attribute est obligatoire lorsque :values est présent.",
    'required_without' => "Le champ :attribute est obligatoire lorsque :values n'est pas présent.",
    'required_without_all' => "Le champ :attribute est obligatoire lorsque aucun de :values n'est présent.",
    'same' => ":Attribute et :other doivent être identiques.",
    'size' => [
        'numeric' => "Le champ :attribute doit être égal à :size.",
        'file' => "Le fichier :attribute doit faire :size kilo-octets.",
        'string' => "Le champ :attribute doit contenir :size caractères.",
        'array' => "Le champ :attribute doit contenir :size éléments.",
    ],
    'starts_with' => "Le champ :attribute doit commencer par l'un des éléments suivants :values",
    'string' => "Le champ :attribute doit être une chaîne de caractères.",
    'timezone' => "Le champ :attribute doit être une zone horaire valide.",
    'unique' => "Le champ :attribute est déjà utilisé.",
    'uploaded' => "Le téléchargement du fichier :attribute a échoué.",
    'url' => "Le format du champ :attribute est invalide.",
    'uuid' => "Le champ :attribute doit être un UUID valide.",
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
