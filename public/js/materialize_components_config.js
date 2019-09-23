$(document).ready(function(){
    $('.tooltipped').tooltip();
    $('.materialboxed').materialbox();
    $('.modal').modal();
    $('select').formSelect();
    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        defaultDate: new Date('2000-01-01'),
        maxDate: new Date('2019-12-12'),
        yearRange: 20,
        i18n: {
            cancel: 'Cancelar',
            months: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            monthsShort: [
                'Jan',
                'Fev',
                'Mar',
                'Abr',
                'Mai',
                'Jun',
                'Jul',
                'Ago',
                'Set',
                'Out',
                'Nov',
                'Dez'
            ],
            weekdays: [
                'Domingo',
                'Segunda-feira',
                'Terça-feira',
                'Quarta-feira',
                'Quinta-feira',
                'Sexta-feira',
                'Sábado'
            ],
            weekdaysShort: [
                'Dom',
                'Seg',
                'Ter',
                'Qua',
                'Qui',
                'Sex',
                'Sáb'
            ], 
            weekdaysAbbrev: ['D','S','T','Q','Q','S','S']
                
        }
    });
});