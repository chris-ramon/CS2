<html>
<head>
   <title>Consumir JSON del API de Panoramio desde PHP</title>
</head>

<body>

<?

function leer_contenido_completo($url){
   $fichero_url = fopen ($url, "r");
   $texto = "";
   while ($trozo = fgets($fichero_url, 1024)){
      $texto .= $trozo;
   }
   return $texto;
}


$URL_API_PANORAMIO = "http://www.panoramio.com/map/get_panoramas.php?order=popularity&set=full&from=0&to=5&minx=-0.35&miny=39.44&maxx=-0.34&maxy=39.46&size=medium";

$contenido_url = leer_contenido_completo($URL_API_PANORAMIO);

echo $contenido_url;

$JSON_PANORAMIO_PHP = json_decode($contenido_url);

echo "<hr>";

//echo $JSON_PANORAMIO_PHP->count; //esto muestra el n�mero de fotos totales que existen en Panoramio en esa localizaci�n
for ($i=0; $i<count($JSON_PANORAMIO_PHP->photos); $i++){
   $foto_actual = $JSON_PANORAMIO_PHP->photos[$i];
   echo "<p>";
   echo "<img src='" . $foto_actual->photo_file_url . "' width='" . $foto_actual->width . "' height='" . $foto_actual->height . "'>";
   echo "<br>";
   echo "<small>" . $foto_actual->photo_title . ", por " . $foto_actual->owner_name . "</small>";
   echo "</p>";
}
?>
</body>
</html>