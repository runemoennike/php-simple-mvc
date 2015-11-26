<?php
namespace SimpleMvc;

function CleanText($unsafeStr) {
    return strip_tags($unsafeStr);
}