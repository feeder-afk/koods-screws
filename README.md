# koods-screws
Una clase simple para crear etiquetas html utilizando array.

### Cómo usar

Creando una etiqueta p simple.

```
use koods\Screws;

$p = new Screws([
    'kind' => 'p',
    'content' => 'Contenido de ejemplo'
]);

echo $p;
// >>> <p>Contenido de ejemplo</p>
```
También puedes imprimir directamente el objeto de de la siguiente forma `echo new Screws(...`

Puedes agregar propiedades indicándolas con `props`

```
echo new Screws([
    'kind' => 'span',
    'props' => [
        'id' => 'myid',
        'class' => 'class1 class2'
    ],
    'content' => 'Hello World'
]);
// >>>  <span id="myid" class="class1 class2">Hello World</span>
```

El `content` es opcional, al usar etiquetas img, meta, etc, o cualquiera que no necesita cierre, todo el `content` será ignorado

```
echo new Screws([
    'kind' => 'img',
    'props' => [        
        'src' => '/imagen.jpg',
        'alt' => 'mi imagen jpg'
    ],
    'content' => 'Hello World'
]);
// >>> <img src="/imagen.jpg" alt="mi imagen jpg"/>
```

En html cada etiqueta puede tener en su interior otras etiquetas, los screws mantienen este comportamiento aceptando en su `content`, texto, screws, o un array con la estructura de un screws, la clase los interpretará como si de un objeto se tratase

```
$p = new Screws([
    'kind' => 'p',
    'content' => 'Contenido de ejemplo'
]);

echo new Screws([
    'kind' => 'div',
    'props' => [
        'id' => 'mydiv'        
    ],
    'content' => $p
]);
// >>> <div id="mydiv" class="col-md-12 my-class"><p>Contenido de ejemplo</p></div> 

echo new Screws([
    'kind' => 'div',
    'props' => [
        'id' => 'mydiv'        
    ],
    'content' => [
        'kind' => 'img',
        'props' => [        
            'src' => '/imagen.jpg',
            'alt' => 'mi imagen jpg'
        ],
        'content' => 'Hello World'
    ]
]);
// >>> <div id="mydiv"><img src="/imagen.jpg" alt="mi imagen jpg"/></div>
```

Sucede que en html, no solo se tienen etiquetas padres e hijas, sino también existen los hermanos, esto es toda una familia, screws acepta un array de screws o lo que se le paresca

```
$p = new Screws([
    'kind' => 'p',
    'content' => 'Contenido de ejemplo'
]);

echo new Screws([
    'kind' => 'div',
    'props' => [
        'id' => 'mydiv',
        'class' => 'col-md-12 my-class'
    ],
    'content' => [
        $p,
        [
            'kind' => 'p',
            'props' => [
                'id' => 'myp'
            ],
            'content' => new Screws([
                'kind' => 'img',
                'props' => [        
                    'src' => '/imagen.jpg',
                    'alt' => 'mi imagen jpg'
                ],
                'content' => 'Hello World'
            ])
        ],
        '<br/>texto plano'
    ]
]);
/* OUT >>>
<div id="mydiv" class="col-md-12 my-class">
    <p>Contenido de ejemplo</p>
    <p id="myp">
        <img src="/imagen.jpg" alt="mi imagen jpg"/>
    </p>
    <br/>texto plano</div>
*/

```
