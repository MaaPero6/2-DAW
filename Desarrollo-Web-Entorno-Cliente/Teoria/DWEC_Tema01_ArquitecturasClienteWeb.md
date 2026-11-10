# Desarrollo web en entorno cliente - Tema 1: Arquitecturas y tecnologías de programación sobre clientes web

## 📌 Resumen Ejecutivo y Objetivos

Toda aplicación web se apoya en el modelo **cliente/servidor**: el trabajo se reparte entre el dispositivo del usuario (ordenador, tableta o móvil), que descarga, interpreta y pinta la interfaz, y uno o varios servidores remotos que custodian los datos y ejecutan la lógica crítica. Este tema describe esa división, los mecanismos internos con los que el navegador ejecuta código, los lenguajes implicados, la naturaleza de la programación de guiones y las herramientas con las que se desarrolla y prueba todo ello.

El tema se corresponde con el **Resultado de Aprendizaje RA1** («Selecciona las arquitecturas y tecnologías de programación sobre clientes web, identificando y analizando las capacidades y características de cada una») y se desglosa en seis criterios de evaluación, cada uno ponderado con un 16,67 % del RA1 (0,833 % de la calificación final del módulo):

| Criterio | Enunciado | Apartado |
|---|---|---|
| CE 1.a | Caracterizar y diferenciar los modelos de ejecución en servidor y cliente | 1.1 |
| CE 1.b | Identificar las capacidades y mecanismos de ejecución del navegador | 1.2 |
| CE 1.c | Identificar y caracterizar los principales lenguajes de cliente | 1.3 |
| CE 1.d | Reconocer las particularidades de los guiones y sus ventajas/desventajas | 1.4 |
| CE 1.e | Verificar los mecanismos de integración de lenguajes de marcas y programación | 1.5 |
| CE 1.f | Reconocer y evaluar las herramientas de programación y prueba | 1.6 |

Al terminar el estudio el alumnado debe ser capaz de: (1) justificar en qué lado de la arquitectura ubicar cada operación; (2) explicar qué ocurre dentro del navegador desde que llega el HTML hasta que se pintan los píxeles; (3) distinguir HTML, CSS y JavaScript por su naturaleza y responsabilidad; (4) comparar un lenguaje interpretado con uno compilado; (5) integrar scripts en un documento HTML sin bloquear el renderizado; y (6) elegir y manejar un entorno de desarrollo y las DevTools con criterio profesional.

## 📖 Desarrollo Teórico Detallado

### 1.1. Modelos de ejecución: cliente y servidor

La Web nació en 1989 en el CERN, creada por **Tim Berners-Lee** para que los científicos compartieran documentos enlazados entre sí. Su normalización corresponde al **W3C** (World Wide Web Consortium), organismo que fija los estándares para que una página se comporte igual en cualquier navegador; su delegación española es www.w3c.es.

Dos transformaciones explican la arquitectura actual. La primera es el **cloud computing**: las empresas ya no mantienen salas de servidores propias, sino que contratan capacidad bajo demanda en plataformas como AWS. La segunda es la **especialización de roles**: diseñadores UX/UI (color, tipografía, distribución), programadores de cliente o *front-end* (componentes interactivos), programadores de servidor o *back-end* (persistencia, transacciones, control de accesos) y administradores de bases de datos (integridad y optimización de los datos).

**El entorno servidor** es la infraestructura no visible. Se ejecuta en servidores dedicados o instancias cloud y el usuario nunca accede a su código fuente. Sus tareas típicas son autenticar identidades y gestionar sesiones, procesar cobros, y consultar bases de datos: relacionales/SQL (MySQL, MariaDB, PostgreSQL, Oracle), que guardan la información en tablas de filas y columnas, o documentales/NoSQL (MongoDB), que la organizan en documentos. Lenguajes habituales: PHP, Java, Python, Node.js y C# (.NET).

**El entorno cliente** es la capa de presentación. Se ejecuta localmente en el navegador, consumiendo CPU, RAM y batería del propio dispositivo. Se sustenta en tres pilares: **HTML** (armazón estructural: títulos, párrafos, tablas, imágenes, formularios), **CSS** (presentación: colores, tipografías, maquetación adaptativa) y **JavaScript** (lógica interactiva: respuesta a eventos, alteración dinámica del documento y validación inmediata de datos).

La premisa que gobierna todo el tema es la **visibilidad del código**: lo que se ejecuta en el cliente es público. Cualquiera puede abrir F12 y leer, auditar o modificar el HTML y el JavaScript en ejecución. Por tanto, claves de cifrado, contraseñas y operaciones contables o de seguridad **jamás** pueden residir exclusivamente en el cliente.

| Dimensión | Cliente (front-end) | Servidor (back-end) |
|---|---|---|
| Entorno de ejecución | Navegador del usuario | Servidor físico o instancia cloud |
| Visibilidad del código | Público (inspeccionable con F12) | Privado |
| Tecnologías clave | HTML5, CSS3, JavaScript (React, Vue, Angular) | PHP, Python, Java, Node.js, C# |
| Acceso a datos | Indirecto, por peticiones HTTP | Directo, conexión nativa SQL/NoSQL |
| Consumo de recursos | CPU, RAM y batería locales | Potencia y memoria del servidor |
| Latencia | Inmediata en acciones visuales locales | Sujeta a red y carga del servidor |
| Nivel de seguridad | Bajo (modificable por el usuario) | Alto (núcleo fiable de permisos y cobros) |

**Evolución de la navegación.** En el modelo clásico cada clic o envío de formulario lanzaba una petición síncrona; el servidor ensamblaba un documento HTML completo y la interfaz sufría un parpadeo y una pantalla en blanco. En el modelo moderno de **Single Page Application (SPA)** la plantilla y los recursos base se descargan una sola vez; las interacciones posteriores no recargan la página, sino que JavaScript pide de forma asíncrona solo los datos necesarios —empaquetados en **JSON**— y actualiza selectivamente las partes del árbol visual que cambian.

**Criterio de asignación de tareas.** La regla es: *lo que aporta usabilidad e inmediatez va al cliente; lo que exige integridad y seguridad va al servidor*. Son propios del cliente desplegar menús, modales y acordeones, cambiar estilos ante eventos de ratón, y ordenar o filtrar colecciones ya cargadas en memoria. Son exclusivos del servidor los cobros con pasarelas de pago (el importe se calcula en servidor para impedir alteraciones maliciosas), las consultas complejas sobre miles o millones de registros y la comprobación de privilegios y roles antes de conceder accesos administrativos.

### 1.2. Capacidades y mecanismos de ejecución del navegador

Un navegador es la aplicación cliente que solicita páginas por HTTP/HTTPS, interpreta el código recibido y lo muestra de forma interactiva. Internamente se organiza en **siete módulos**:

1. **Interfaz de usuario**: barra de direcciones, pestañas, botones de avance/retroceso y menús.
2. **Motor del navegador (browser engine)**: puente entre la interfaz y los motores internos.
3. **Motor de renderizado**: lee HTML y CSS, calcula tamaño y posición de cada elemento y lo dibuja.
4. **Motor de JavaScript**: intérprete que traduce y ejecuta el código; emplea compilación **JIT (Just-In-Time)**, detectando las funciones que más se ejecutan y traduciéndolas a código máquina nativo.
5. **Capa de red**: envía y recibe datos, resuelve nombres DNS y comprueba certificados HTTPS.
6. **Backend de interfaz (UI backend)**: conecta con el sistema operativo para dibujar controles con aspecto nativo.
7. **Almacenamiento de datos**: cookies, caché y bases de datos locales en disco.

Es fundamental entender que el **motor de renderizado y el motor de JavaScript son piezas separadas**: cuando un script cambia un texto, debe avisar al motor de renderizado para que recalcule y repinte esa zona.

| Navegador | Motor de renderizado | Motor de JavaScript | Organización |
|---|---|---|---|
| Google Chrome | Blink | V8 | Google |
| Microsoft Edge | Blink | V8 | Microsoft |
| Mozilla Firefox | Gecko | SpiderMonkey | Fundación Mozilla |
| Apple Safari | WebKit | JavaScriptCore | Apple |
| Brave / Opera | Blink | V8 | Brave Software / Opera |

Dos notas de interés: en iPhone y iPad las normas de la App Store obligan a que **todo** navegador use internamente WebKit, y Blink nació en 2013 como bifurcación de WebKit, que era el motor original de Chrome.

**Del código a los píxeles.** El renderizado sigue cuatro pasos: (1) construcción del **DOM** (árbol de etiquetas) y del **CSSOM** (árbol de reglas de estilo); (2) unión de ambos en el **árbol de renderizado**, del que quedan excluidos los nodos sin presencia visual, como `<head>` o lo marcado con `display: none`; (3) **layout o disposición**, que calcula ancho, alto y coordenadas de cada caja según el tamaño de ventana; (4) **paint o pintado**, que dibuja colores, bordes, tipografías e imágenes píxel a píxel. Advertencia importante: si el navegador encuentra un `<script>` mientras lee el HTML, **detiene el análisis** hasta descargarlo y ejecutarlo; un script pesado deja la pantalla en blanco.

**APIs nativas.** El navegador ofrece funciones listas para usar desde JavaScript: manipulación del DOM; peticiones en segundo plano con `fetch()`; almacenamiento local; y acceso a dispositivos físicos con permiso del usuario (geolocalización por GPS o Wi-Fi, cámara, micrófono, estado de batería y de red).

| Mecanismo | Capacidad | Persistencia | Uso típico |
|---|---|---|---|
| Cookies | ~4 KB | Configurable, viaja al servidor en cada petición | Mantener la sesión iniciada |
| `sessionStorage` | Unos MB | Se borra al cerrar la pestaña | Datos temporales de una pestaña |
| `localStorage` | 5-10 MB | Permanente en el equipo | Preferencias del usuario |
| `IndexedDB` | Gran volumen | Permanente | Aplicaciones que funcionan sin conexión |

Como no todos los navegadores incorporan las novedades a la vez, se comprueba la existencia de la API antes de usarla (`if ('geolocation' in navigator)`) y se consulta el sitio **Can I Use**.

**DOM y BOM.** El DOM es la representación estructurada en memoria de todos los elementos de la página, con forma de árbol invertido: `window` → `document` → `<html>` → `<head>`/`<body>` → resto de nodos. JavaScript no dibuja directamente: busca nodos, lee propiedades, altera contenido o crea y borra etiquetas; cada cambio obliga al motor de renderizado a recalcular y repintar. El **BOM** es la jerarquía superior: `window` representa la ventana o pestaña completa y es el objeto raíz global; `document` cuelga de él (`window.document`). Por el ámbito global, `window.alert("Mensaje")` y `alert("Mensaje")` son funcionalmente idénticos.

**Mecanismos de salida.** Existen cuatro vías principales:

- **`console.log()`**: canal hacia el panel de diagnóstico (F12 → Consola), invisible para el usuario común; admite variantes como `console.error()`, `console.warn()`, `console.time()` y `console.timeEnd()` para medir tiempos.
- **`innerHTML`**: lee o sobrescribe el marcado interno de un nodo. Es peligroso con datos de usuario: permite inyectar un `<script>` malicioso (**XSS**). Para texto plano es preferible `textContent`, más rápido e inmune a inyecciones.
- **`document.write()`**: escribe en el flujo de la página durante la carga; si se invoca cuando el documento ya ha terminado de cargarse, **borra irreversiblemente** todo el HTML existente. No se recomienda en desarrollos modernos.
- **`window.alert()`**: diálogo modal nativo, **síncrono y bloqueante**: congela el hilo principal hasta que el usuario pulsa «Aceptar», deteniendo animaciones y eventos.

**Reflow y repaint.** Alterar el DOM no es gratis. El **reflow** (o re-layout) ocurre cuando el cambio afecta a dimensiones o posición —cambiar `fontSize` o inyectar bloques con `innerHTML`—: el navegador recalcula el espacio del nodo y cómo desplaza a los vecinos. El **repaint** ocurre cuando solo cambia una propiedad visual sin alterar el espacio físico, como `color` o `backgroundColor`. Consecuencia práctica: los reflows continuos dentro de un bucle ralentizan la página y hacen caer los FPS; conviene agrupar las modificaciones visuales.

### 1.3. Los lenguajes de la programación cliente

La tríada estándar reparte responsabilidades con nitidez. **HTML** es un lenguaje de **marcado**, no de programación: delimita la semántica y la estructura del documento y el navegador lo interpreta de forma homogénea si respeta los estándares del W3C. **CSS** es un lenguaje **declarativo** de diseño: define aspecto, proporciones, márgenes y adaptabilidad (*responsive*), sin intervenir en lógica ni datos. **JavaScript** es un lenguaje de programación **dinámico, débilmente tipado y orientado a eventos**: inyecta dinamismo, reacciona a clics y teclas, valida entradas y altera el documento sin recargar.

Por los riesgos del dinamismo en aplicaciones complejas —especialmente financieras— el estándar de la industria es **TypeScript**: no es un lenguaje nuevo, sino una capa sobre JavaScript que añade **tipado estático** comprobado mientras se programa y que al compilarse se transforma en JavaScript estándar que el navegador entiende.

| Lenguaje | Naturaleza | Responsabilidad | Se ejecuta |
|---|---|---|---|
| HTML | Marcado (etiquetas) | Estructura y semántica | Interpretado por el navegador |
| CSS | Declarativo de estilo | Presentación y maquetación | Interpretado por el navegador |
| JavaScript | Programación dinámico, orientado a eventos | Comportamiento e interacción | Motor JS (JIT) |
| TypeScript | Superconjunto tipado de JS | Seguridad de tipos en proyectos grandes | Compilado a JavaScript |

**Evolución histórica de JavaScript.** Diseñado en **10 días** por Brendan Eich en Netscape en 1995 con el objetivo de añadir interactividad básica (validar formularios, animaciones sencillas), se ha convertido en el motor de ejecución universal de la web.

| Año | Hito |
|---|---|
| 1995 | Brendan Eich crea Mocha/LiveScript/JavaScript en Netscape |
| 1996 | Microsoft lanza JScript en Internet Explorer 3.0: primera «guerra de navegadores» |
| 1997 | ECMAScript 1 (ECMA-262): estándar neutro |
| 1998-1999 | ES2 y ES3: expresiones regulares, `try/catch`, manejo de cadenas |
| 2000-2008 | Fracaso de ES4; auge de **AJAX** (2005, Jesse James Garrett) y de librerías como jQuery (2006) |
| 2009 | **ES5**: modo estricto, `forEach/map/filter/reduce`, JSON nativo, getters/setters |
| 2008-2009 | Motor **V8** y nacimiento de **Node.js** (Ryan Dahl): JavaScript al backend |
| 2015 | **ES6**: mayor refundición de sintaxis y capacidades del lenguaje |
| 2016+ | Lanzamientos anuales con proceso de 4 fases (Stages 0-4) del TC39 |

**Frameworks y librerías.** En entornos profesionales rara vez se trabaja solo con *Vanilla JS*. Los frameworks aportan coste nulo (código abierto), fiabilidad y rendimiento respaldados por comunidades amplias, velocidad de entrega (*time to market*) con patrones y componentes ya resueltos, y estandarización de equipos.

| Framework | Origen | Rasgo diferencial | Curva de aprendizaje |
|---|---|---|---|
| ReactJS | Meta | Componentes con estado propio, DOM virtual y JSX | Media |
| Angular | Google | Plataforma integral en TypeScript, inyección de dependencias, RxJS | Pronunciada |
| Vue.js | Evan You | Ligereza y DOM virtual; adopción progresiva | Suave |

React mantiene en RAM una copia ligera del DOM; al cambiar los datos calcula las diferencias mínimas con el DOM real (**reconciliación**) y actualiza solo los nodos necesarios. **JSX** es la extensión que permite escribir estructuras tipo HTML dentro del código. AngularJS (versión 1, JavaScript clásico) dio paso a Angular (v2+) con arquitectura fuertemente estructurada. Otras alternativas del mercado son EmberJS, BackboneJS, MeteorJS, Aurelia, Polymer y Mithril.js.

**Funciones.** Un bloque de código reutilizable que se define una vez y se invoca cuantas veces haga falta. Existen tres formas principales: la **declaración** clásica (`function saludar(nombre) { ... }`), que disfruta de *hoisting* y puede invocarse antes de su línea; la **expresión de función** asignada a una variable (`const duplicar = function (n) { return n * 2; }`), que no puede usarse antes de definirse; y las **funciones flecha** de ES6 (`const sumar = (a, b) => a + b;`), con `return` y llaves implícitos si el cuerpo es una sola línea y paréntesis opcionales con un único parámetro.

### 1.4. Particularidades de la programación de guiones

Tradicionalmente el software se construía como aplicaciones aisladas (*standalone*) de gestión empresarial sobre escritorio o arquitecturas cliente/servidor monolíticas. Internet, la ubicuidad del móvil y la necesidad de ejecutar lógica en el navegador cambiaron los requisitos: ya no se programa todo desde cero, se usan **entornos anfitriones** (*host*) donde acoplar rutinas dinámicas.

Los **scripts** nacieron como secuencias de comandos para automatizar tareas repetitivas del sistema operativo y **siempre dependen de un intérprete**. Hoy han superado esa concepción: en la web son programas completos de miles de líneas, con estados, interfaces reactivas y comunicaciones de red. El contraste con los lenguajes tradicionales se articula en cinco ejes:

| Criterio | Lenguaje tradicional | Lenguaje de script |
|---|---|---|
| Ejecución | Compilación previa a código máquina | Interpretación línea a línea en tiempo de ejecución |
| Independencia | Programa *standalone* (nativo en C++, Go, Rust; gestionado en Java/C#) | Integrado en un anfitrión (navegador, intérprete) |
| Construcción | Estructuras y librerías propias desde la base | Reutiliza componentes ya presentes en el anfitrión (DOM, motor gráfico, red) |
| Errores | La compilación actúa como filtro estricto de sintaxis y tipos | Se descubren en *runtime*, lo que exige pruebas exhaustivas |
| Ejemplos | C, C++, Java, Swift, Pascal | JavaScript, Shell, Perl, PHP, Python, Ruby |

Con todo, la frontera se ha difuminado: Python y JavaScript (con Node.js) se ejecutan directamente en la terminal y pueden empaquetarse como aplicaciones independientes con PyInstaller, pkg o Electron.

**Ventajas de los guiones:** sencillez y curva de aprendizaje rápida; agilidad del ciclo de desarrollo (sin tiempos de compilación: se guarda y se recarga); integración natural dentro de otros lenguajes y documentos, como JavaScript en HTML; y portabilidad mediante el anfitrión, ya que funciona en cualquier dispositivo con un navegador conforme a los estándares.

**Desventajas y riesgos:** mayor tasa de errores en tiempo de ejecución (una rama poco transitada puede fallar solo cuando el usuario llega a ella); rendimiento bruto inferior, pues aunque los motores modernos aplican JIT, un lenguaje dinámico interpretado consume más memoria y ciclos que un binario optimizado en C o C++; y exposición del código fuente, que se transfiere al cliente como texto plano.

**Java frente a JavaScript.** Comparten nombre por razones comerciales, pero sus filosofías son opuestas: Java es un lenguaje tradicional, fuertemente tipado, compilado a *bytecode*, rígidamente orientado a objetos y ejecutado en máquina virtual; JavaScript es un lenguaje de script, dinámico, débilmente tipado, interpretado en el navegador y orientado a eventos.

**El objeto `Date`.** Las fechas no son un tipo primitivo, sino instancias de `Date`. Un objeto `Date` es una **instantánea congelada**, no un reloj que se actualiza. Internamente almacena milisegundos desde la **época Unix** (1 de enero de 1970, 00:00:00 UTC); valores positivos son posteriores y negativos, anteriores. `Date.now()` devuelve el timestamp actual sin instanciar nada.

El constructor admite cuatro variantes: sin argumentos (instante actual), con cadena de texto en formato ISO 8601 o RFC 2822 (`new Date("2026-09-28T12:30:00")`), con componentes numéricos (`new Date(2026, 11, 25, 10, 30, 0, 0)`) y con un único número, que **siempre** se interpreta como milisegundos desde 1970 (`new Date(2026)` son 2 026 ms después de la época, no el año 2026). Dos comportamientos notables: los **meses van de 0 a 11** (enero = 0) mientras los días van de 1 en adelante, y existe **desbordamiento automático**: `new Date(2026, 15, 20)` produce abril de 2027 y `new Date(2026, 5, 35)` produce el 5 de julio. Un año entre 0 y 99 se interpreta como siglo XX (95 → 1995).

| Método | Formato | Ejemplo | Uso |
|---|---|---|---|
| `toString()` | Texto completo con zona local | `Mon Sep 28 2026 12:23:57 GMT+0200` | Depuración |
| `toDateString()` | Solo fecha legible | `Mon Sep 28 2026` | Interfaces sin hora |
| `toTimeString()` | Solo hora con huso | `12:23:57 GMT+0200` | Registros horarios |
| `toISOString()` | ISO 8601 en UTC | `2026-09-28T10:23:57.000Z` | Intercambio con APIs |
| `toUTCString()` | HTTP / RFC 7231 | `Mon, 28 Sep 2026 10:23:57 GMT` | Cabeceras y cookies |
| `toLocaleDateString()` | Según localización | `28/9/2026` (es-ES) | Interfaz de usuario |

Para operar por partes se usan *getters* (`getFullYear`, `getMonth`, `getDate`, `getDay` —0 = domingo—, `getHours`, `getTime`) y *setters* (`setFullYear`, `setMonth`, `setDate`).

### 1.5. Integración de lenguajes de marcas y de programación

JavaScript no actúa aislado: se combina con el HTML y el estándar fija cómo, cuándo y en qué orden se procesa la lógica respecto a la estructura. El contenedor oficial es la etiqueta **`<script>`**. En HTML5 basta con abrir y cerrar la etiqueta (el lenguaje se asume JavaScript); el atributo `type="text/javascript"` solo se conserva por compatibilidad histórica. Regla sintáctica estricta: `<script>` **nunca** puede cerrarse de forma abreviada (`<script src="script.js" />`); requiere siempre `</script>`.

| Aspecto | Código externo (`.js`) | Código embebido |
|---|---|---|
| Ubicación | Archivo independiente enlazado con `src` | Entre `<script>` y `</script>` en el HTML |
| Caché del navegador | Sí: se descarga una vez y se reutiliza | No |
| Modularidad | Alta: separa estructura y comportamiento | Baja: mezcla marcado y lógica |
| Mantenimiento | Un solo archivo afecta a todas las páginas | Hay que replicar cambios página a página |
| Cuándo usarlo | Recomendado en proyectos profesionales | Solo fragmentos mínimos y específicos de una página |

En proyectos profesionales los scripts se ubican en un directorio dedicado (`./js/script.js`), junto a `css/` y el `index.html`.

**¿`<head>` o final de `<body>`?** El navegador lee de arriba abajo. Un `<script>` en el `<head>` **bloquea** el análisis del HTML hasta descargarse y ejecutarse; si intenta acceder a un elemento del `<body>` con `getElementById`, fallará porque ese nodo aún no existe en el DOM. La recomendación tradicional es colocar los scripts **al final del `<body>`**, cuando todo el marcado ya está construido. Los estándares modernos ofrecen dos atributos para scripts externos en el `<head>`:

| Atributo | Descarga | Ejecución | Uso idóneo |
|---|---|---|---|
| (ninguno) | Bloquea el parseo | Inmediata al descargar | Scripts críticos pequeños |
| `defer` | En segundo plano | Tras parsear todo el HTML, en orden | Scripts que manipulan el DOM |
| `async` | En segundo plano | En cuanto termina la descarga, sin orden garantizado | Analítica, contadores externos |

### 1.6. Herramientas de programación y prueba

Escribir JavaScript solo requiere un editor de texto plano, pero en un entorno empresarial eso es inviable: faltan verificación de sintaxis, depuración y gestión de proyectos. El ranking de la *Stack Overflow Developer Survey* sitúa a **Visual Studio Code** como estándar absoluto (75,9 % de uso global, más del 80 % entre desarrolladores front-end), con soporte nativo de TypeScript y extensiones como ESLint, Prettier y los snippets de React/Vue. Le siguen Notepad++ (27,4 %, edición rápida de scripts sueltos), Vim/Neovim (38,3 % combinado, para perfiles avanzados en terminal), Cursor (17,9 %, clon de VS Code con IA nativa) y los IDEs de JetBrains, con WebStorm (7,6 %) como referencia comercial por su motor de refactorización.

Conviene distinguir **VS Code** (código base libre, pero instalador con licencia comercial y telemetría) de **VSCodium**, compilación limpia del mismo código fuente sin telemetría ni restricciones, preferida por defensores del software libre. Entre los editores con IA nativa destacan Windsurf (con el modo agente Cascade), Void (código abierto, con claves de API propias o modelos locales) y Zed (escrito en Rust, bajo consumo de RAM y uso de GPU).

Criterios técnicos para elegir entorno: código abierto y gratuidad, arquitectura modular, gestor de paquetes integrado, autocompletado predictivo, sistema de paneles múltiples y canales de soporte comunitario.

**Control de versiones.** **Git** es el sistema distribuido que rastrea cada modificación de los archivos; **GitHub** aloja repositorios y añade revisión por pares (*pull requests*), seguimiento de incidencias (*issues*) e integración continua. Los editores modernos integran paneles nativos para hacer *commits*, cambiar de rama y resolver conflictos sin salir del entorno.

**IDEs en la nube.** Cuando no se puede —o no merece la pena— configurar un entorno local, plataformas como Coding Ground (Tutorialspoint), CodeSandbox, StackBlitz o JSFiddle ofrecen editor con resaltado, previsualización y consola, y permiten arrancar proyectos React, Angular o Vue en segundos desde el navegador.

**DevTools.** Accesibles con F12 o Ctrl+Shift+I, integran al menos tres paneles esenciales: **Consola** (interacción con el motor JS en tiempo real y errores en rojo), **Fuentes/Debugger** (examen de archivos `.js`, puntos de interrupción, inspección de variables paso a paso y pila de llamadas) y **Red/Network** (todas las peticiones HTTP con su código de estado —200, 404, 500—, tiempo de transferencia y tamaño).

| Parámetro | Editor ligero / online | IDE completo |
|---|---|---|
| Escenario idóneo | Pruebas de concepto, correcciones puntuales, hardware limitado | Proyectos medianos y grandes con frameworks |
| Consumo de recursos | Mínimo | Medio-alto |
| Control de versiones | Limitado a exportar archivos | Integración profunda con Git y GitHub |
| Personalización | Escasa o nula | Elevada, vía extensiones y paquetes |

## 💡 Ejemplos Prácticos y Aplicaciones

**Ejemplo 1. La misma operación en cada lado de la arquitectura.** Calcular el total de un carrito es una tarea de presentación; fijar el importe que se cobra es una tarea de integridad. El cliente puede mostrar un subtotal, pero el servidor debe recalcularlo:

```javascript
// CLIENTE: solo estimación visual, nunca vinculante
function mostrarSubtotal(precios) {
  const subtotal = precios.reduce((acc, p) => acc + p, 0);
  document.getElementById("subtotal").textContent =
    `Subtotal estimado: ${subtotal.toFixed(2)} €`;
}

// SERVIDOR (Node.js/Express): el importe real se calcula aquí
app.post("/api/pedido", (req, res) => {
  const importe = req.body.lineas.reduce(
    (acc, l) => acc + l.precioUnitario * l.cantidad, 0
  );
  res.json({ importeFinal: importe }); // el navegador no puede alterarlo
});
```

**Ejemplo 2. Manipulación del DOM con las tres facetas.** Contenido, atributos y estilo, agrupando los cambios para minimizar reflows:

```html
<p id="estado">Sistema en espera</p>
<button id="btnActivar">Activar</button>

<script>
  const estado = document.getElementById("estado");

  document.getElementById("btnActivar").addEventListener("click", () => {
    estado.textContent = "Sistema activo";     // contenido (seguro, sin XSS)
    estado.style.backgroundColor = "#c8f7c5";  // repaint
    estado.style.fontSize = "20px";            // reflow
  });
</script>
```

Obsérvese la regla **camelCase**: `background-color` en CSS se convierte en `style.backgroundColor` y `font-size` en `style.fontSize`, porque el guion es el operador de resta en JavaScript.

**Ejemplo 3. Medir el coste del trabajo en cliente.** El siguiente patrón, derivado de la práctica de auditoría de rendimiento, permite comprobar con `console.time` cuánto tarda el navegador en ordenar un array grande:

```javascript
let catalogo = [];
for (let i = 1; i <= 150000; i++) {
  catalogo.push({ id: i, precio: Math.random() * 900 + 10 });
}

console.time("Ordenación en CPU cliente");
catalogo.sort((a, b) => a.precio - b.precio);
console.timeEnd("Ordenación en CPU cliente");
```

Al pasar de 150.000 a 500.000 registros el tiempo no crece linealmente, porque `sort` no es lineal. La conclusión arquitectónica es doble: ordenar en cliente ahorra consultas `ORDER BY` al servidor y reparte la carga entre miles de navegadores, pero **no es viable** descargar inventarios de millones de registros; en ese caso la solución es la **paginación** y el filtrado en servidor.

**Ejemplo 4. Fechas: diferencia en días y último día del mes.** Dos utilidades que explotan `getTime()` y el desbordamiento del constructor:

```javascript
function calcularDiasDiferencia(inicio, fin) {
  const MS_DIA = 1000 * 60 * 60 * 24;
  const a = new Date(inicio).getTime();
  const b = new Date(fin).getTime();
  return Math.round((b - a) / MS_DIA); // round absorbe el cambio de hora
}

function obtenerUltimoDiaMes(anio, mesHumano) {
  // Día 0 del mes siguiente = último día del mes indicado
  return new Date(anio, mesHumano, 0).getDate();
}

function formatearFechaEspanola(f) {
  const d = String(f.getDate()).padStart(2, "0");
  const m = String(f.getMonth() + 1).padStart(2, "0");
  return `${d}/${m}/${f.getFullYear()}`;
}
```

**Ejemplo 5. Estructura de proyecto e integración correcta.**

```text
mi_proyecto/
├── css/
│   └── estilos.css
├── js/
│   └── logica.js
└── index.html
```

```html
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Proyecto DWEC</title>
  <link rel="stylesheet" href="./css/estilos.css">
  <script defer src="./js/logica.js"></script>
</head>
<body>
  <h1>Práctica de integración</h1>
  <button id="btnCambiar">Cambiar color</button>
</body>
</html>
```

Con `defer`, el script se descarga en paralelo y se ejecuta cuando el DOM está completo, por lo que puede usar `getElementById` sin riesgo. La comprobación en la pestaña **Network** debe mostrar `200 OK` para `logica.js`.

**Aplicación integradora.** Para una tienda pequeña, la decisión razonable es: HTML/CSS/JS con `fetch` al servidor, ordenación y filtrado de la página visible en cliente, cálculo del importe y cobro en servidor, `localStorage` para el carrito persistente, y `Date` para mostrar plazos de entrega con `toLocaleDateString()`. Todo el desarrollo se apoya en VS Code con Live Server, Git para el historial y las DevTools para verificar red y depurar.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

### Preguntas de autoevaluación

**1. ¿Por qué el código del cliente es público y qué consecuencia de seguridad se deriva?**
Porque el navegador descarga HTML, CSS y JavaScript como texto plano y cualquier usuario puede abrirlo con F12, leerlo y modificarlo en ejecución. Consecuencia: nunca deben residir exclusivamente en el cliente claves de cifrado, contraseñas ni la lógica que fija importes o permisos; esas operaciones se ejecutan siempre en servidor.

**2. Diferencia entre motor de renderizado y motor de JavaScript. ¿Pueden ser el mismo?**
No. El de renderizado (Blink, Gecko, WebKit) construye DOM/CSSOM, calcula layout y pinta; el de JavaScript (V8, SpiderMonkey, JavaScriptCore) interpreta y ejecuta código con compilación JIT. Son piezas separadas y se comunican: un cambio hecho por el script obliga al renderizador a recalcular y repintar.

**3. Enumera y explica los cuatro pasos del renderizado.**
(1) Construcción del DOM a partir del HTML y del CSSOM a partir del CSS; (2) unión de ambos en el árbol de renderizado, que excluye nodos sin presencia visual como `<head>` o `display: none`; (3) layout o disposición, que calcula tamaño y coordenadas de cada caja; (4) paint o pintado de píxeles en pantalla.

**4. ¿Qué diferencia hay entre reflow y repaint? Pon un ejemplo de cada uno.**
El reflow altera geometría o posición (`style.fontSize = "25px"`, inyectar HTML) y obliga a recalcular el espacio del nodo y de sus vecinos. El repaint solo cambia una propiedad visual sin afectar al espacio (`style.color = "red"`), y el navegador se limita a repintar píxeles.

**5. ¿Por qué colocar un `<script>` en el `<head>` puede provocar un error? ¿Qué dos soluciones existen?**
Porque el navegador detiene el parseo del HTML al encontrarlo; si el script intenta acceder a un elemento del `<body>`, ese nodo aún no existe en el DOM y `getElementById` devuelve `null`. Soluciones: mover el script al final del `<body>` o usar el atributo `defer` (o `async` si no depende del DOM).

**6. Diferencia entre `defer` y `async`.**
Ambos descargan en segundo plano sin bloquear el parseo. `defer` ejecuta el script cuando el HTML está completamente parseado y respeta el orden de aparición; `async` lo ejecuta en cuanto termina la descarga, sin garantizar orden, lo que lo hace adecuado para analítica pero no para scripts que manipulan el DOM.

**7. ¿Por qué es peligroso `innerHTML` y qué alternativa existe?**
Porque interpreta el contenido como marcado: si incluye datos escritos por un usuario, puede inyectarse un `<script>` malicioso y ejecutar código en el navegador de otros (XSS). Para texto plano debe usarse `textContent`, que no interpreta etiquetas y además es más rápido.

**8. Un `<script>` externo, ¿debe cerrarse de forma abreviada?**
No. `<script src="script.js" />` no es válido: la etiqueta debe cerrarse siempre con `</script>`, incluso cuando se enlaza un archivo externo sin contenido interno.

**9. Cita tres diferencias entre un lenguaje de script y uno tradicional.**
(1) El tradicional se compila a código máquina antes de ejecutarse; el script se interpreta línea a línea en runtime. (2) El tradicional genera programas independientes; el script se integra en un anfitrión, aunque hoy pueda empaquetarse. (3) En el tradicional los errores de sintaxis y tipos se detectan al compilar; en el script aparecen durante la ejecución, lo que exige más pruebas.

**10. ¿Qué devuelve `new Date(2026, 12, 1)` y por qué? ¿Y `new Date(2026)`?**
`new Date(2026, 12, 1)` devuelve el **1 de enero de 2027**: los meses van de 0 a 11, y el desbordamiento automático convierte el mes 12 en enero del año siguiente. `new Date(2026)` devuelve el instante situado 2.026 milisegundos después de la época Unix (1970), porque un único argumento numérico siempre se interpreta como milisegundos, nunca como año.

**11. ¿Qué aporta TypeScript frente a JavaScript y cómo llega al navegador?**
Añade tipado estático e interfaces, de modo que los errores de tipo se detectan mientras se programa. No lo ejecuta el navegador: se compila a JavaScript estándar, que es lo que finalmente se descarga e interpreta.

**12. Para una tienda online con 10.000 usuarios reordenando el catálogo, ¿dónde se ordena y por qué?**
En el cliente, sobre los datos ya descargados: cada navegador usa su propia CPU, se eliminan miles de consultas `ORDER BY` concurrentes y el servidor se reserva para lo que exige integridad (precios finales, cobros, permisos). El límite es el volumen: con millones de registros no se descarga todo, sino que se pagina y se filtra en servidor.

### Conceptos clave

- **Modelo cliente/servidor**: reparto de trabajo entre el dispositivo del usuario y servidores remotos.
- **Front-end / Back-end**: capa de presentación ejecutada en el navegador / infraestructura de datos y lógica en servidor.
- **W3C**: consorcio que fija los estándares de la Web.
- **SPA (Single Page Application)**: aplicación que carga la plantilla una vez y actualiza solo datos y fragmentos del DOM.
- **DOM (Document Object Model)**: representación en árbol de la página en memoria; puente entre JavaScript y la pantalla.
- **BOM**: jerarquía del navegador cuyo objeto raíz es `window`, del que cuelga `document`.
- **Motor de renderizado / motor de JavaScript**: módulos separados que pintan y ejecutan, respectivamente.
- **Compilación JIT**: traducción a código máquina nativo de las funciones más ejecutadas.
- **Reflow y repaint**: recálculo de geometría / repintado de píxeles tras un cambio.
- **ECMAScript**: estándar del lenguaje JavaScript (ES3, ES5, ES6/2015 y versiones anuales).
- **AJAX / `fetch()`**: obtención asíncrona de datos sin recargar la página.
- **DOM virtual y reconciliación**: copia ligera del DOM en RAM y cálculo de diferencias mínimas (React, Vue).
- **TypeScript**: superconjunto tipado de JavaScript que se compila a JavaScript estándar.
- **Lenguaje interpretado vs. compilado**: ejecución línea a línea con intérprete frente a traducción previa a binario.
- **`defer` / `async`**: atributos que evitan el bloqueo del parseo por scripts externos.
- **DevTools**: paneles Consola, Fuentes y Red para depurar y auditar la aplicación.
