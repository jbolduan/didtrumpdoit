var today = moment();
var inaguration = moment('2025-01-20')
var election = moment('2024-11-05')

$('#inaguration-days').html(inaguration.diff(today, 'days') > 0 ? inaguration.diff(today, 'days') : 'NA');

$('#days-in-office').html(today.diff(inaguration, 'days') > 0 ? today.diff(inaguration, 'days') : 0);

$('#days-since-election').html(today.diff(election, 'days') > 0 ? today.diff(election, 'days') : 0);
