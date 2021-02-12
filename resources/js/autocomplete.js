require('easy-autocomplete');
var options = {
    url: "/json/lt_cities.json",
    getValue: "name",
    list: {
        match: {
            enabled: true
        }
    },
    theme: "plate-dark"
};
$('.autocomplete-city').easyAutocomplete(options);
