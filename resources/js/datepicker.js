require('datetimepicker');
$('#datetimepicker').DateTimePicker(
    {
        shortDayNames: ["Sekm", "Pirm", "Antr", "Treč", "Ketv", "Penk", "Šešt"],
        fullMonthNames: ["Sausis", "Vasaris", "Kovas", "Balandis", "Gegužė", "Birželis", "Liepa", "Rugpjūtis", "Rūgsėjis", "Spalis", "Lapkritis", "ruodis"],
        minDateTime: Date($.now()),
    }
);
