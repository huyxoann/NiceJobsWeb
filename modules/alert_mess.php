<?php
function show($message)
{
    return '
    <div class="alert alert-danger" role="alert">
        ' . $message . '
    </div>';
}
