<?php

function createPrepare($connection, $query, $types, $args) {

    $stmt = $connection->prepare($query);
    $stmt->bind_param($types, ...$args);

    return $stmt;
}

?>
