<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabla de Pokémon</title>
    <style>
        .pokemon {
            display: inline-block;
            width: 100px;
            height: 100px;
            margin: 10px;
            text-align: center;
            cursor: pointer;
            border: 1px solid #ccc;
            padding: 10px;
        }
    </style>
</head>
<body>
    <h1>Tabla de Pokémon</h1>

    <?php
    // URL de la API PokeAPI para obtener todos los Pokémon
    $url = "https://pokeapi.co/api/v2/pokemon/";
    
    // Inicializar la variable para almacenar todos los Pokémon
    $all_pokemon = [];

    // Obtener todos los Pokémon
    while ($url) {
        // Obtener los datos de la API
        $pokemon_data = file_get_contents($url);

        if ($pokemon_data) {
            // Decodificar los datos JSON
            $pokemon_list = json_decode($pokemon_data);

            // Agregar los resultados a la lista de todos los Pokémon
            $all_pokemon = array_merge($all_pokemon, $pokemon_list->results);

            // Actualizar la URL para obtener la próxima página de resultados, si existe
            $url = $pokemon_list->next;
        } else {
            echo "Error al obtener los datos de la API.";
            break;
        }
    }

    // Mostrar los Pokémon y sus datos
    foreach ($all_pokemon as $pokemon) {
        echo "<div class='pokemon' onclick='verDetalle(\"" . $pokemon->name . "\")'>$pokemon->name</div>";
    }
    ?>

    <script>
        function verDetalle(nombrePokemon) {
            // Redirigir a la página de detalle del Pokémon seleccionado
            window.location.href = "detalle.php?nombre=" + encodeURIComponent(nombrePokemon);
        }
    </script>
</body>
</html>
