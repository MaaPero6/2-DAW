# Diseño de interfaces Web - Tema 3: CSS

## 📌 Resumen Ejecutivo y Objetivos

CSS (*Cascading Style Sheets*) describe la presentación de un documento HTML. Si el marcado aporta estructura y significado, la hoja de estilos determina tipografía, color, espaciado, dimensiones, disposición de bloques y adaptación al dispositivo. La separación entre contenido y presentación permite reutilizar el mismo documento en pantalla, impresión o lectura por voz sin duplicar el marcado.

Una hoja de estilos es un conjunto de reglas. Cada regla consta de un selector, que identifica los elementos afectados, y una definición entre llaves formada por declaraciones `propiedad: valor;`. El navegador aplica además estilos por defecto a cada etiqueta, que toda regla del autor sobrescribe. Comprender ese mecanismo de conflicto, junto con el modelo de caja, es la base del diseño de interfaces.

El tema recorre selectores y cascada, unidades y colores, modelo de caja, texto y fuentes, listas y tablas, posicionamiento de contenedores y diseño responsive con Bootstrap.

**Objetivos de aprendizaje**

- Escribir reglas CSS correctas y elegir el selector adecuado según la estructura del documento.
- Predecir qué declaración prevalece cuando varias reglas afectan al mismo elemento.
- Dimensionar y maquetar con unidades relativas, controlando el modelo de caja.
- Aplicar estilos de texto, listas y tablas con criterios de legibilidad.
- Maquetar con `display`, `position`, `float` y `z-index`, adaptando el resultado con *media queries*.
- Utilizar el sistema de rejilla de Bootstrap y sus clases de utilidad.

## 📖 Desarrollo Teórico Detallado

### 1. Selectores y especificidad

El selector responde a «¿a qué elemento se aplica el estilo?»; la definición responde a «¿qué cambia y cómo?». La sintaxis es `elemento { propiedad: valor; }` y el bloque admite tantas declaraciones como sean necesarias.

| Selector | Sintaxis | Selecciona |
|---|---|---|
| Universal | `*` | Todos los elementos del DOM |
| Etiqueta | `p` | Todos los elementos de ese tipo |
| Clase | `.clase` | Elementos con ese atributo `class` |
| Identificador | `#id` | El elemento con ese `id`, único en el documento |
| Descendiente | `sel1 sel2` | `sel2` dentro de `sel1`, a cualquier profundidad |
| Hijo directo | `sel1 > sel2` | `sel2` hijo inmediato de `sel1` |
| Adyacente | `sel1 + sel2` | `sel2` hermano que sigue a `sel1` |
| Combinación | `sel1, sel2` | Todos los selectores enumerados |

```css
* { margin: 0; padding: 0; }                  /* universal */
.destacado { color: #c0392b; }                /* clase */
#cabecera { margin-left: 165px; }             /* identificador */
article p { line-height: 1.6; }               /* descendiente */
article > p { text-indent: 1.5em; }           /* hijo directo */
h2 + p { margin-top: 0.5em; }                 /* adyacente */
h1, h2 { font-family: Arial, sans-serif; }     /* combinación */
```

El descendiente incluye nietos y niveles inferiores; el hijo directo exige parentesco inmediato. Con `p em` se subrayan todos los `em` de un párrafo, incluso dentro de un `strong`; con `p > em`, solo los que cuelgan directamente de él.

Un elemento puede llevar varias clases —`class="blend otro-estilo"`— y recibir los estilos de ambas; si las dos declaran la misma propiedad, prevalece la última clase declarada. Es un caso del mecanismo general: cuando varias reglas compiten no gana la escrita más abajo, sino la de mayor **especificidad**; solo en caso de empate decide el orden de aparición.

El orden de peso es: estilo en línea, identificador, clase o pseudo-clase, etiqueta y, por último, el selector universal.

Un selector compuesto suma sus componentes: `#menu a.activo` pesa más que `.activo`. Conviene mantener selectores planos, porque encadenar identificadores y clases produce hojas difíciles de sobrescribir; la recomendación es usar clases cuando el estilo se repite y reservar los identificadores para estilos únicos.

Completan el repertorio los **selectores de atributo** (`[href]`, `[type="text"]`), las **pseudo-clases de estado** (`:link`, `:visited`, `:hover`, `:active`, `:focus`), las **estructurales** (`:first-child`, `:nth-child(n)`, `:empty`) y los **pseudo-elementos** (`::before`, `::after`).

### 2. Unidades de medida y colores

Las dimensiones se expresan en unidades absolutas, siempre iguales, o relativas, dependientes del dispositivo y del contexto.

| Absolutas | Significado | Relativas | Referencia |
|---|---|---|---|
| `px` | Píxel | `em` | Tamaño de fuente del elemento |
| `in` | Pulgada (2,54 cm) | `%` | Tamaño del elemento padre |
| `cm` / `mm` | Centímetro / milímetro | `vh` / `vw` | 1 % del alto / ancho del *viewport* |
| `pt` | Punto (1/72 in) | `fr` | Fracción del espacio libre en Grid |
| `pc` | Pica (12 pt) | `rem` | Tamaño de fuente del elemento raíz |

El píxel se considera absoluto, pero su tamaño físico varía con la densidad de pantalla: en un Retina es más pequeño y produce mayor nitidez. Aun así, se recomiendan las unidades relativas; centímetros, pulgadas y puntos quedan para impresión.

La unidad `em` es proporcional al tamaño de fuente: con el valor habitual del navegador, 16 px equivalen a 1 em, 12 px a 0,75 em y 20 px a 1,25 em. Como el usuario puede modificar ese tamaño base, `em` refuerza la accesibilidad.

`vh` y `vw` se refieren al área visible del navegador, no al contenedor: `50vh` es siempre la mitad de la ventana, aunque el contenedor cambie. Esa independencia las hace útiles para secciones a pantalla completa.

Los colores admiten nombre predefinido —`black` `#000000`, `white` `#ffffff`, `red` `#ff0000`, `gray` `#808080`—, hexadecimal `#RRGGBB` o `#RRGGBBAA`, RGB, RGBA, HSL y HSLA. `opacity` afecta al elemento completo, hijos incluidos; `rgba()` solo hace transparente el color.

| Propiedad | Función | Valores |
|---|---|---|
| `color` | Color del texto | nombre, HEX, RGB, HSL, RGBA |
| `background-color` | Color de fondo | los anteriores más `transparent` |
| `background-image` | Imagen de fondo | `url("...")`, `none` |
| `background-repeat` | Repetición | `repeat`, `repeat-x`, `no-repeat` |
| `background-position` | Posición inicial | porcentaje, `left`, `center`, `right` |
| `background-size` | Tamaño | `auto`, `cover`, `contain` |
| `background-attachment` | Desplazamiento | `scroll`, `fixed` |
| `opacity` | Transparencia | 0 (invisible) a 1 (opaco) |

```css
.cta {
  background-image: url("cta-background.jpg");
  background-size: cover;        /* cubre el contenedor, recortando el exceso */
  background-position: center center;
  background-repeat: no-repeat;
  background-attachment: fixed;  /* efecto parallax al hacer scroll */
  color: #ffffff;
  opacity: 0.9;
}
```

`cover` cubre todo el contenedor recortando el exceso; `contain` ajusta la imagen completa, con posible espacio vacío si la proporción no coincide.

### 3. El modelo de caja

Todo elemento es una caja rectangular con cuatro zonas concéntricas: contenido, relleno (`padding`), borde (`border`) y margen (`margin`). El relleno es espacio interior que forma parte del fondo; el margen es espacio exterior, siempre transparente. `margin` y `padding` aceptan de uno a cuatro valores, en orden superior, derecho, inferior e izquierdo.

| Propiedad | Función | Valores |
|---|---|---|
| `width` / `height` | Ancho y alto del área de contenido | longitud, `auto` |
| `max-width` / `min-width` | Límites horizontales | longitud, `none`, `0` |
| `padding` | Relleno (1 a 4 valores) | longitud, porcentaje |
| `margin` | Margen (1 a 4 valores) | longitud, porcentaje, `auto` |
| `border` | Grosor, estilo y color | `1px solid #333` |
| `border-radius` | Curvatura de las esquinas | longitud, porcentaje |
| `box-sizing` | Interpretación del tamaño | `content-box`, `border-box` |
| `overflow` | Desbordamiento | `visible`, `hidden`, `scroll`, `auto` |

Por defecto rige `content-box`: el `width` se aplica solo al contenido y relleno y borde se suman. Un elemento con `width: 100px`, `padding: 10px` y `border: 2px` ocupa 124 px. Con `border-box` esos 100 px incluyen todo, lo que hace predecible el reparto en columnas porcentuales.

```css
*, *::before, *::after {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}
```

El margen automático (`margin: 0 auto`) centra horizontalmente una caja de ancho fijo. `overflow` resuelve el desbordamiento: `hidden` lo recorta, `scroll` fuerza barras y `auto` las muestra solo si son necesarias.

### 4. Texto y tipografía

Las propiedades de texto actúan sobre el bloque —interlineado, separación, alineación—; las de fuente modifican la letra.

| Propiedad | Función | Valores |
|---|---|---|
| `text-indent` | Sangría de la primera línea | longitud, porcentaje |
| `text-align` | Alineación horizontal | `left`, `right`, `center`, `justify` |
| `text-decoration` | Subrayado y tachado | `none`, `underline`, `overline`, `line-through` |
| `text-transform` | Transformación de caja | `capitalize`, `uppercase`, `lowercase`, `none` |
| `letter-spacing` / `word-spacing` | Espacio entre caracteres / palabras | `normal`, longitud |
| `line-height` | Interlineado | longitud, porcentaje, número |
| `vertical-align` | Alineación vertical | `top`, `middle`, `bottom`, `baseline`, `sub`, `super` |
| `font-family` | Familias tipográficas | lista con genérica final |
| `font-size` | Tamaño | palabra clave, longitud, porcentaje |
| `font-weight` | Grosor | `normal` (400), `bold` (700), 100–900 |
| `font-style` / `font-variant` | Inclinación / versalitas | `italic`, `oblique` / `small-caps` |

```css
body {
  font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
  font-size: 16px;
  line-height: 1.5;
  color: #222222;
}

.entradilla {
  font-size: 1.25em;
  text-align: justify;
  letter-spacing: 0.02em;
}
```

En `font-family` debe cerrarse la lista con una familia genérica (`serif`, `sans-serif`, `monospace`), que actúa como respaldo. `line-height` sin unidad se interpreta como múltiplo del tamaño de fuente y es la forma más robusta de fijar interlineado. Los formatos web habituales son EOT, TTF, WOFF, WOFF2 y SVG.

### 5. Listas y tablas

Las listas se controlan con cuatro propiedades, tres específicas y una abreviada:

| Propiedad | Función | Valores |
|---|---|---|
| `list-style-type` | Forma del marcador | `disc`, `circle`, `square`, `decimal`, `lower-roman`, `upper-alpha`, `none` |
| `list-style-image` | Imagen como marcador | `url("...")`, `none` |
| `list-style-position` | Posición del marcador | `inside`, `outside` |
| `list-style` | Atajo de las tres anteriores | `square outside` |

```css
.menu {
  list-style: none;   /* sin viñetas */
  padding: 0;
  margin: 0;
}

.menu li { display: inline-block; }

.lista-iconos li::before { content: "😊"; margin-right: 10px; }
```

`list-style-image` apenas controla tamaño y posición; para precisión se elimina el marcador y se dibuja con `::before`, fijando `width`, `height` y `background-image`.

| Propiedad de tabla | Función | Valores |
|---|---|---|
| `caption-side` | Posición del título | `top`, `bottom` |
| `table-layout` | Cálculo de anchos | `auto`, `fixed` |
| `border-collapse` | Modelo de bordes | `collapse`, `separate` |
| `border-spacing` | Separación entre celdas | una o dos longitudes |
| `empty-cells` | Celdas vacías | `show`, `hide` |

```css
.tabla-datos { width: 100%; table-layout: fixed; border-collapse: collapse; }
.tabla-datos th, .tabla-datos td { padding: 10px 12px; border-bottom: 1px solid #ddd; }
```

`border-spacing` solo actúa con `border-collapse: separate`; de hecho, `border-spacing: 0` equivale a `collapse`. `table-layout: fixed` acelera el renderizado y evita que una celda larga desproporcione la tabla.

### 6. Posicionamiento y contenedores

`display` decide cómo participa una caja en el flujo; `position`, si se sale de él.

`display: none` oculta sin reservar espacio; `inline` ignora `width`, `height` y márgenes verticales; `block` ocupa una línea propia y admite dimensiones; `inline-block` combina ambas posibilidades.

| `position` | Referencia y efecto |
|---|---|
| `static` | Flujo normal; `top`, `right`, `bottom` y `left` no se aplican |
| `relative` | Se desplaza respecto a su posición natural, sin liberar el hueco |
| `absolute` | Respecto al primer ancestro posicionado; sale del flujo |
| `fixed` | Respecto a la ventana; permanece inmóvil al hacer scroll |
| `sticky` | Relativo hasta alcanzar el umbral, luego fijo |

```css
.caja { position: relative; width: 300px; height: 300px; }

.etiqueta {
  position: absolute;   /* respecto a .caja, su ancestro posicionado */
  top: 60px;
  right: 0;
  width: 200px;
}

.barra-superior {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 70px;
  z-index: 1;
}
```

Si un elemento `absolute` no encuentra un ancestro posicionado, se referencia a la ventana. Un `fixed` sale del flujo, por lo que los bloques siguientes quedan bajo la barra: se corrige con un `padding-top` en el `body` igual al alto de la barra. `sticky` fija una cabecera al llegar a `top: 0` sin JavaScript.

`float` saca la caja del flujo y la pega a izquierda o derecha, con el texto rodeándola; `clear` (`left`, `right`, `both`) restaura el flujo. Cuando varias cajas se superponen, `z-index` decide el apilado: valores mayores quedan delante. `visibility: hidden` oculta el elemento pero conserva su espacio.

### 7. Diseño responsive y Bootstrap

CSS permite declarar hojas para medios concretos (`all`, `print`, `screen`, `speech`), tanto en el enlace como en la propia hoja:

```css
@media screen and (min-width: 768px) {
  .contenido { width: 70%; float: left; }
}

@media screen and (max-width: 767px) {
  .contenido, .lateral { width: 100%; float: none; }
}
```

Las *media queries* combinan condiciones con `and` y admiten rangos cerrados. Lo habitual es partir del diseño móvil y añadir complejidad con `min-width`, o corregir desde el escritorio con `max-width`.

Bootstrap es un framework de HTML, CSS y JavaScript creado por Mark Otto y Jacob Thornton en Twitter y publicado como código abierto en 2011. Aporta rejilla, componentes y utilidades ya programadas. Su sistema de columnas usa flexbox: la pantalla se divide en filas y cada fila en un máximo de 12 columnas.

| Pantalla | Extra small | Small | Medium | Large | Extra large |
|---|---|---|---|---|---|
| Ancho | < 576 px | ≥ 576 px | ≥ 768 px | ≥ 992 px | ≥ 1200 px |
| Contenedor | auto | 540 px | 720 px | 960 px | 1140 px |
| Prefijo | `.col-` | `.col-sm-` | `.col-md-` | `.col-lg-` | `.col-xl-` |

```html
<div class="container">
  <div class="row">
    <div class="col-xl-6 col-md-5 col-sm-4">Primera</div>
    <div class="col-xl-6 col-md-5 col-sm-4">Segunda</div>
  </div>
</div>
```

`.container` centra el contenido con ancho fijo por tramos; `.container-fluid` ocupa el 100 %. `col` sin número reparte el espacio a partes iguales y `col-4` fija cuatro de las doce fracciones; si la suma excede de 12, el sobrante pasa a la fila siguiente. Al declarar `.col-md-6` el tamaño se aplica también a los tramos superiores; por debajo, la columna ocupa el ancho completo.

Bootstrap 4 define `font-size: 16px`, `line-height: 1.5` y la pila `"Helvetica Neue", Helvetica, Arial, sans-serif`; los encabezados van de 2,5 rem (`h1`) a 1 rem (`h6`). Sus utilidades cubren tipografía (`.lead`, `.text-center`), color (`.text-danger`, `.bg-dark`), tablas (`.table-striped`) e imágenes (`.img-fluid`). Los componentes —navbar, carousel, cards, formularios— se insertan como bloques resueltos. Bootstrap 5 añade el tramo `xxl`, elimina jQuery y prescinde de Internet Explorer.

## 💡 Ejemplos Prácticos y Aplicaciones

**1. Sección *hero* con fondo fijo.** `background-attachment: fixed` junto con `background-size: cover` produce el efecto de paralaje: la imagen queda anclada a la ventana mientras el contenido se desplaza. Sin `fixed`, el fondo acompaña al contenedor.

```css
.parallax {
  background-image: url("hero.jpg");
  height: 400px;
  background-attachment: fixed;
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  position: relative;
}
```

**2. Maqueta de blog con barra lateral.** Contenedor centrado a 1000 px, `main` al 70 % y `aside` al 30 %, ambos flotados. El `footer`, al 70 %, necesita `clear: both` para no montarse sobre las columnas. La *media query* convierte las tres zonas en bloques al 100 % por debajo de 800 px.

```css
* { margin: 0; padding: 0; box-sizing: border-box; }

.contenedorPrincipal {
  max-width: 1000px;
  margin: 0 auto;
  font-family: Arial, sans-serif;
  background-color: #425067;
}

main { float: left; width: 70%; background-color: #ffffff; }
aside { float: left; width: 30%; padding: 30px; background-color: #25d6c8; }
footer { clear: both; width: 70%; padding: 60px; background-color: #e52f6e; }

@media (max-width: 800px) {
  main, aside, footer { width: 100%; float: none; display: block; }
}
```

**3. Menú horizontal con estados.** Se elimina la viñeta, se alinean los elementos en línea y se declaran los estados del enlace en el orden `:link`, `:visited`, `:hover`, `:active` para que la cascada no anule el efecto.

```css
nav ul { list-style: none; }
nav li { display: inline-block; }
nav a {
  display: inline-block;
  padding: 15px 20px;
  color: #2d3646;
  text-decoration: none;
}
nav a:hover { background-color: #e52f6e; color: #ffffff; }
```

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

**Preguntas**

**1. ¿Qué diferencia hay entre `p em` y `p > em`?**
El primero es descendiente y alcanza cualquier `em` contenido en un `p`, aunque esté dentro de otro elemento; el segundo exige que el `em` sea hijo inmediato del párrafo. En `<p><strong><em>texto</em></strong></p>` solo actúa el primero.

**2. Si un párrafo tiene las clases `.a` y `.b`, y ambas definen `color`, ¿cuál se aplica?**
La de `.b`, por ser la última declarada en el atributo `class`: ambas tienen igual especificidad y en caso de empate decide el orden.

**3. ¿Por qué se recomienda `em` frente a `px` para el tamaño de texto?**
Porque `em` es relativo al tamaño de fuente y, en última instancia, al configurado por el usuario: si este amplía la letra base, el diseño escala de forma coherente. Con `px` se compromete la accesibilidad.

**4. ¿Qué diferencia hay entre `vh` y `%`?**
`%` se calcula sobre el contenedor y cambia con él; `vh` se calcula sobre el alto del *viewport*, de modo que `50vh` es siempre la mitad de la ventana visible.

**5. Un elemento tiene `width: 200px`, `padding: 20px` y `border: 5px`. ¿Cuánto ocupa con el modelo por defecto?**
Con `content-box`, los 200 px son solo de contenido y se suman relleno y borde por ambos lados: 250 px. Con `border-box`, el contenido se reduce a 150 px.

**6. ¿En qué se diferencian `display: none` y `visibility: hidden`?**
Ambos ocultan el elemento, pero `display: none` lo retira del flujo y no reserva espacio, mientras que `visibility: hidden` conserva su hueco y no desplaza la maquetación.

**7. ¿Respecto a qué se posiciona un elemento `absolute`?**
Respecto al primer ancestro con posición distinta de `static`; si no existe, respecto a la ventana. Además, sale del flujo y no genera espacio.

**8. ¿Para qué sirve `z-index` y cuándo tiene efecto?**
Fija el nivel de apilado: a mayor valor, más cerca del usuario. Solo actúa sobre elementos posicionados o ítems de un contenedor flex o grid.

**9. ¿Qué hace `border-collapse: collapse` y qué propiedad anula?**
Fusiona los bordes de celdas adyacentes en un único trazo y elimina el espacio entre ellas. En modelo colapsado, `border-spacing` deja de tener efecto.

**10. ¿Cómo se comporta `.col-md-6` en pantallas pequeñas?**
Ocupa la mitad del ancho desde 768 px en adelante; por debajo de ese umbral pasa al 100 % del contenedor, salvo que se declaren clases para tramos inferiores.

**Conceptos clave**

- **Regla CSS**: selector + bloque de declaraciones `propiedad: valor`.
- **Especificidad**: peso de un selector en la cascada; en línea > identificador > clase > etiqueta.
- **Cascada**: resuelve conflictos entre reglas; a igual peso decide el orden.
- **Modelo de caja**: contenido, `padding`, `border` y `margin`.
- **`box-sizing: border-box`**: el tamaño declarado incluye relleno y borde.
- **Unidad relativa**: `em`, `%`, `vh`, `vw`, `fr`; dependen del contexto o del dispositivo.
- **`display`**: `inline`, `block`, `inline-block`, `none`.
- **`position`**: `static`, `relative`, `absolute`, `fixed`, `sticky`.
- **Flotación**: `float` y `clear` en la maquetación tradicional; `z-index`, orden de apilado.
- **Media query**: regla condicional por ancho o características del dispositivo.
- **Rejilla Bootstrap**: 12 columnas y cinco tramos (seis con `xxl` en la versión 5).
