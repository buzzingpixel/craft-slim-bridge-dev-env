<?php

return [
    '/some/craft/route' => 'some-template-or-action',
    '/another/craft/route' => 'another-template-or-action',
    '<path:.*>' => 'slim-bridge/route-handler/index',
];
