<?php

return [
    'number' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}</a></li>',
    'current' => '<li class="page-item active"><a class="page-link" href="#">{{text}}<span class="sr-only">(current)</span></a></li>',
    'nextActive' => '<li class="page-item"><a class="page-link" aria-label="Next" href="{{url}}">{{text}}</a></li>',
    'nextDisabled' => '<li class="page-item disabled"><a class="page-link" class="page-item" aria-label="Next"><span aria-hidden="true">NEXT</span></a></li>',
    'prevActive' => '<li class="page-item"><a class="page-link" aria-label="Previous" href="{{url}}">{{text}}</a></li>',
    'prevDisabled' => '<li class="page-item disabled"><a class="page-link" aria-label="Previous"><span aria-hidden="true">PREVIOUS</span></a></li>',
    'first' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}<span aria-hidden="true"></span></a></li>',
    'last' => '<li class="page-item"><a class="page-link" href="{{url}}">{{text}}<span aria-hidden="true"></span></a></li>',
];

