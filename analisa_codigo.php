<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE);

function identificadores(){

}

function numero_inteiro(){

}

function string(){
    
}

$palavras_reservadas = [
    'void',
    'char',
    'int',
    'float',
    'double',
    'long',
    'signed',
    'unsigned',
    'const',
    'volatile',
    'auto',
    'static',
    'extern',
    'register',
    'typedef',
    '#include',
    '#define',
    '#undef',
    '#line',
    '#error',
    '#if',
    '#else',
    '#ifdef',
    '#ifndef',
    '#elif',
    '#endif',
];

$simbolos = [
    '=','+','-','/','*','(',')',';'
];


echo json_encode($tokens);
