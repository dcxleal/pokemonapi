<?php
// Verificar si se recibió un nombre de Pokémon
if(isset($_GET['nombre'])){
    $nombrePokemon = urldecode($_GET['nombre']); // Decodificar el nombre del Pokémon

    // URL de la API PokeAPI para obtener los detalles del Pokémon por su nombre
    $url = "https://pokeapi.co/api/v2/pokemon/$nombrePokemon";

    // Obtener los detalles del Pokémon
    $pokemon_details = file_get_contents($url);

    // Verificar si se obtuvieron los detalles correctamente
    if ($pokemon_details !== false) {
        // Decodificar los datos JSON
        $pokemon_details = json_decode($pokemon_details, true); // true para obtener un array asociativo

        // Verificar si la decodificación fue exitosa
        if ($pokemon_details !== null) {
            // Mostrar los detalles del Pokémon y sus habilidades
            echo "<h1>Detalle de $nombrePokemon</h1>";
            if (isset($pokemon_details['sprites']['front_default'])) {
                echo "<img src='" . $pokemon_details['sprites']['front_default'] . "' alt='$nombrePokemon'>";
            } else {
                echo "<p>No hay imagen disponible para $nombrePokemon.</p>";
            }
            echo "<h2>Habilidades:</h2>";
            echo "<ul>";
            foreach ($pokemon_details['abilities'] as $ability) {
                echo "<li>" . $ability['ability']['name'] . "</li>";
            }
            echo "</ul>";
        } else {
            echo "<h1>Error: No se pudieron decodificar los detalles del Pokémon.</h1>";
        }
    } else {
        echo "<h1>Error: No se pudieron obtener los detalles del Pokémon.</h1>";
    }
} else {
    // Si no se proporcionó un nombre de Pokémon, mostrar un mensaje de error
    echo "<h1>Error: No se proporcionó un nombre de Pokémon.</h1>";
}
?>

