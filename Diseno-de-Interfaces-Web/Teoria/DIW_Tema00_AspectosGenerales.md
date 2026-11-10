# Diseño de interfaces Web - Tema 0: Aspectos generales

## 📌 Resumen Ejecutivo y Objetivos

Una página web se ejecuta sobre un computador con una arquitectura concreta: un procesador que ejecuta instrucciones en secuencia, interrupciones que alteran esa secuencia, un reloj que marca el ritmo y una jerarquía de memoria con costes de acceso muy dispares. Ese sustrato explica por qué una interfaz responde con fluidez o se vuelve pesada.

Objetivos: describir la arquitectura von Neumann y sus registros; explicar la secuencia del procesador y sus rupturas; diferenciar interrupción síncrona y asíncrona; distinguir las tres acepciones del reloj y justificar la jerarquía de memoria.

## 📖 Desarrollo Teórico Detallado

### 1.1 Estructura y funcionamiento del computador

La arquitectura von Neumann consta de cuatro componentes: unidad aritmético-lógica (UAL o ALU), memoria principal (RAM y ROM), unidad de control y unidades de entrada/salida. Se denomina procesador o unidad central de proceso (UCP/CPU) al conjunto de la UAL y la unidad de control; hoy un circuito integrado incluye varios procesadores, los núcleos o *cores*.

La memoria principal son celdas idénticas; el direccionamiento selecciona una celda para lectura o escritura. Las direcciones identifican bytes, pero el acceso se hace sobre una palabra de 4 u 8 bytes. El programa máquina es el conjunto de instrucciones que persigue una función; todo programa de alto nivel debe convertirse en él para ejecutarse.

La UAL opera aritmética y lógicamente sobre uno o dos operandos tomados de registros o memoria y guarda el resultado en registros o memoria. Además genera bits que carga en el registro de estado: acarreo, cero, signo y desbordamiento (1 si se produce cada uno); son los que deciden el salto condicional.

La unidad de control hace funcionar al conjunto cíclicamente: lee la instrucción, la interpreta, lee los datos referenciados, la ejecuta y almacena el resultado. Usa el contador de programa (PC), con la dirección de la siguiente instrucción; el puntero de pila (SP), que maneja una pila en memoria; el registro de instrucción (RI), con la instrucción en curso; y el registro de estado (RE), con bits aritméticos, modo de ejecución y control de interrupciones.

La unidad de E/S transfiere información entre memoria o registros y periféricos, bajo gobierno de la UCP o mediante acceso directo a memoria (DMA). Hay dos modos de ejecución: usuario y privilegiado o núcleo (*kernel*); el de usuario no permite E/S ni modificar los registros de gestión de memoria.

### 1.2 El procesador: secuencia y registros de control

La unidad de control repite a gran velocidad una secuencia encadenada: (a) lectura de la instrucción apuntada por el PC, (b) incremento del PC, (c) interpretación y ejecución, con posible lectura de operandos y almacenamiento de resultados. Es lineal y directa, lo que implica un bucle infinito.

Existe una instrucción de parada (HALT) que detiene la unidad de control hasta que llegue una interrupción. Lo normal es desviar la secuencia, para lo cual hay tres mecanismos: instrucciones de salto o bifurcación; interrupciones externas o internas, con las que el sistema operativo modifica el PC para saltar a otro programa; y la instrucción de llamada al sistema (TRAP, INT, SC), de efecto similar.

Los registros de control y estado son PC, SP (dos pilas: usuario y sistema), RI y registro de estado, con bits aritméticos, modo de ejecución y control de interrupciones, más los de gestión de memoria (protección, identificador de espacio), no visibles en modo usuario. Todos los registros en un instante forman el estado del procesador; su subconjunto visible es el estado visible.

### 1.3 Interrupciones

Una interrupción se solicita activando una señal que llega a la unidad de control. El agente que la activa es el solicitante; el que se ejecuta, el interrumpido.

Si está habilitada, la unidad de control ejecuta el ciclo de aceptación: salva estado y contador de programa en la pila del sistema; eleva el modo al privilegiado; carga en el PC la rutina de tratamiento del sistema operativo; e inhabilita las interrupciones y lee el vector, que fija el comienzo de esa rutina y se organiza en la tabla de interrupciones (IDT). La rutina corre en modo privilegiado por seguridad: un programa de usuario no debe acceder a datos de otros usuarios.

Es síncrona cuando deriva directamente de las instrucciones en ejecución, y asíncrona en el resto. Las excepciones hardware síncronas o de programa recogen problemas de ejecución: operación inválida, división por cero, desbordamiento, dispositivo no existente, memoria inválida o privilegiada en modo usuario, desbordamiento de pila, violación de límites, error de alineación y código de operación inválido. Incluyen la depuración por punto de ruptura y el fallo de página.

Las asíncronas de hardware son errores del hardware: paridad en bus, paridad en memoria, fallo de alimentación, temperatura excedida. El módulo que las produce genera el vector y puede dejar el código del problema en un registro o en la pila.

Las externas son asíncronas y las producen elementos ajenos al procesador: el reloj; los controladores de E/S, por fin de operación o atención; y otros procesadores. A ellas se suman las instrucciones de llamada al sistema (TRAP, INT, SYSTENTER, SC), que permiten a un programa generar una interrupción síncrona.

RETI restituye estado y PC desde la pila. Las solicitudes se organizan en niveles INT1…INTn con prioridad: primero las asíncronas de hardware, luego las síncronas y las externas. La inhibición puede ser selectiva, con registros de máscara y de nivel, o global mediante el bit global de inhibición (BGI): el de nivel inhibe las de prioridad menor o igual a la que contiene y el de máscara tiene un bit por línea. Las no atendidas quedan pendientes, y el tratamiento exige preservar en la pila los registros no salvados y restituirlos al retornar.

### 1.4 El reloj

El término admite tres acepciones: la señal que gobierna el ritmo de ejecución de las instrucciones (CLK); el generador de interrupciones periódicas o temporizador; y el contador de fecha y hora o reloj de tiempo real (RTC).

Un microprocesador de 5 GHz tiene un oscilador que produce una onda cuadrada de esa frecuencia; un divisor la divide para generar una interrupción externa cada cierto intervalo: el *tick*. Esas interrupciones hacen que el sistema operativo conmute entre procesos de usuario y tareas propias: es la planificación por turnos. En la arquitectura PC clásica, el PIC 8254 produce un *tick* de 54,92618 ms.

El RTC da fecha y hora tomando como referencia un instante dado (p. ej. las 0 horas del 1 de enero de 1990); es el equivalente electrónico del reloj de pulsera. Suele alimentarse de forma permanente; el PC clásico lo hace con pila y lo gobierna con un cristal de 32,768 kHz.

El texto advierte de un desbordamiento: en UNIX el tiempo son segundos desde las 0 horas del 1 de enero de 1970 y con 32 bits sin signo el máximo es 2.147.483.647 s, las 3 h 14 min 7 s del 19 de enero de 2038; a partir de ahí el contador vuelve a 0.

### 1.5 Jerarquía de memoria

La memoria de alta velocidad es cara y de tamaño reducido, por lo que se organiza en jerarquía: memorias permanentes lentas y de gran capacidad (discos) para el almacenamiento, y memorias de semiconductores pequeñas y rápidas para la información en uso.

Los niveles son: 0, registros; 1, caché; 2, memoria principal; 3, discos (magnéticos, SSD, ópticos, cinta). La propiedad que la define es doble: velocidad creciente y tamaño decreciente hacia arriba.

| Nivel | Tipo | Tamaño típico | Tiempo de acceso | Unidad de transferencia |
|---|---|---|---|---|
| 0 | Registros | 64 – 1.024 bytes | 0,25 – 0,5 ns | Palabra |
| 1 | Memoria caché | 8 KiB – 8 MiB | 0,5 – 20 ns | Palabra (línea de 32 – 128 bytes) |
| 2 | Memoria principal | 128 MiB – 64 GiB | 60 – 200 ns | Palabra |
| 3a | Disco SSD | 128 GiB – 1 TiB | 50 µs | Sector |
| 3b | Disco magnético | 256 GiB – 4 TiB | 5 – 30 ms | Sector |

El funcionamiento exige copiar información entre niveles; la gestiona el sistema operativo con ayuda del hardware, con migración automática (hardware) o explícita (la pide el programa, como un editor).

La caché debe su nombre al francés *cacher* (ocultar) y no es visible al programa máquina: es una copia de la información recientemente utilizada, con la esperanza de que vuelva a emplearse pronto, lo que explota la localidad temporal. El bloque que se migra es la línea (32–128 bytes), que gestiona el hardware; puede haber varios niveles en el chip.

La memoria virtual es un mecanismo automático que exige hardware y sistema operativo: memoria principal más memoria de respaldo (*swap*, parte del disco). El mapa se divide en páginas y la MMU (*Memory Management Unit*) traduce la dirección virtual a física con la tabla de páginas. Si la página no está en memoria se produce un fallo de página y el sistema operativo la trae del disco con una política de reemplazo. La TLB cachea la tabla de páginas para no acceder a memoria en cada traducción; en modo real la MMU no traduce.

### 2. El sistema operativo: componentes y servicios

Los componentes son el gestor de procesos, el de memoria, el de comunicación y sincronización entre procesos y el de seguridad (identificación de usuarios y control de accesos). Ofrecen servicios mediante una interfaz de llamadas al sistema (API); el programador puede elegir entre interfaces —Windows y UNIX— sin mezclar servicios de varias extensiones.

Un programa es un conjunto de instrucciones máquina; un proceso es ese programa en ejecución, la unidad de procesamiento del sistema operativo. Varios usuarios pueden ejecutar el mismo programa, que debe estar en un fichero ejecutable. La imagen de memoria comprende el mapa de memoria, la información del proceso (registros, PC, SP, estado) y el BCP o bloque de control. Sus servicios son crear un proceso desde la imagen del padre (*fork* en UNIX, *CreateProcess* en Windows), ejecutarlo en modo *batch*, interactivo o en segundo plano, terminarlo por fin normal, por error —división por cero, acceso no permitido— o por otro proceso (*kill*), y cambiar el ejecutable (*exec*).

La gestión de memoria asigna la imagen, proporciona y libera memoria a petición, trata los errores de acceso, permite memoria compartida y gestiona la jerarquía y los fallos de página. Sus servicios son solicitar memoria (con dirección de comienzo), liberar y compartir.

La comunicación y sincronización se apoya en tuberías o *pipes*, memoria compartida y *sockets*: mecanismos con ciclo de vida (crear, enviar o escribir, recibir o leer, destruir). Puede ser síncrona (emisor y receptor actúan a la vez) o asíncrona (uno espera).

## 💡 Ejemplos Prácticos y Aplicaciones

**1. Repintado y coste del fallo de caché.** Al recomponer una zona de la página, el navegador escribe píxeles en búferes y relee estructuras que acaba de recorrer. En caché el acceso cuesta 0,5–20 ns; en memoria principal, 60–200 ns; si el dato fue expulsado al disco, 50 µs–30 ms: un acceso a disco cuesta cientos de miles de veces más que un acierto en caché. Por eso las interfaces que reutilizan nodos y estilos se perciben fluidas y las que recorren estructuras dispersas, a saltos.

**2. Memoria del navegador y memoria virtual.** Un navegador con muchas pestañas acumula información en memoria principal; cuando el conjunto de trabajo supera la disponible, el sistema recurre al *swap* y cada página ausente provoca un fallo que se resuelve trayéndola del disco. El efecto no es un error sino lentitud intermitente: pausas del orden del acceso al nivel 3, en ráfagas, no constantes.

**3. Latencia e interrupciones de entrada.** Cada pulsación o movimiento del ratón llega con una interrupción externa del controlador del dispositivo. Atenderla exige salvar estado, cambiar a modo privilegiado y ejecutar la rutina; el evento se encola y el proceso que dibuja lo recoge cuando le toca el turno. De ahí que la misma entrada se sienta inmediata sin carga y retardada cuando muchas interrupciones compiten por prioridad.

**4. Llamadas al sistema y aislamiento.** Pedir un fichero, abrir un *socket* o reservar memoria implica una llamada al sistema: una instrucción tipo TRAP que eleva el modo de ejecución y ejecuta código del sistema operativo en modo privilegiado. El navegador, en modo usuario, no puede hacer E/S: depende de esa frontera, la misma que impide que el código de una página acceda a los datos de otra, y por eso leer del disco o enviar por red cuesta más que operar en memoria.

## ⚠️ Conceptos Clave para Examen y Preguntas de Autoevaluación

**Conceptos clave**

1. **Arquitectura von Neumann**: UAL, memoria principal, unidad de control y unidades de E/S; la UCP es UAL más control.
2. **Programa máquina**: instrucciones máquina en que debe convertirse todo programa de alto nivel.
3. **Registro de estado**: bits de acarreo, cero, signo y desbordamiento, más modo y control de interrupciones.
4. **PC, SP, RI y RE**: contador de programa, puntero de pila, registro de instrucción y de estado.
5. **Estado del procesador**: todos los registros en un instante; el visible en modo usuario es el estado visible.
6. **Ciclo de aceptación**: salvar estado y PC en la pila, elevar el modo, cargar el PC desde el vector, inhibir y leer la IDT.
7. **Síncrona frente a asíncrona**: la primera deriva de las instrucciones en ejecución; la segunda es externa o error del hardware.
8. **Enmascaramiento**: registro de nivel (prioridad menor o igual), de máscara (un bit por línea) y bit global de inhibición.
9. **Tres acepciones del reloj**: señal CLK, temporizador de interrupciones periódicas y RTC.
10. **Jerarquía de memoria**: registros, caché, memoria principal y discos; más velocidad y menos tamaño hacia arriba.
11. **Memoria virtual**: páginas, MMU, tabla de páginas, fallo de página y TLB.
12. **Proceso frente a programa**: el programa es un conjunto de instrucciones; el proceso, ese programa en ejecución con imagen de memoria y BCP.

**Preguntas de autoevaluación**

**1. ¿Qué dos unidades forman la CPU y qué hace cada una?**
La UAL opera aritmética y lógicamente y genera los bits de estado; la unidad de control lee, interpreta y ejecuta las instrucciones y gobierna el sistema.

**2. Describa la secuencia básica del procesador.**
Lectura de la instrucción apuntada por el PC, incremento del PC e interpretación y ejecución, con lectura de operandos. Es lineal y directa, por lo que se repite indefinidamente.

**3. ¿Por qué la rutina de tratamiento se ejecuta en modo privilegiado?**
Por seguridad: un programa de usuario no debe acceder a datos de otros usuarios, y el ciclo de aceptación eleva el modo para habilitar ese acceso.

**4. Enumere los pasos del ciclo de aceptación.**
Salvar estado y PC en la pila del sistema; elevar el modo al privilegiado; cargar en el PC la rutina de tratamiento; e inhibir las interrupciones y leer el vector en la IDT.

**5. Diferencie interrupción síncrona, excepción asíncrona de hardware e interrupción externa, con un ejemplo de cada una.**
Síncrona: deriva de la instrucción en ejecución, como la división por cero o el fallo de página. Asíncrona de hardware: error del hardware, como paridad en memoria o temperatura excedida. Externa: la produce un elemento ajeno, como el reloj o el controlador de E/S al terminar una operación.

**6. ¿Qué diferencia hay entre el registro de nivel y el de máscara?**
El de nivel inhibe las interrupciones de prioridad menor o igual a la que contiene; el de máscara tiene un bit por línea y permite inhibir selectivamente cualquiera. Cabe la inhibición global (BGI).

**7. Explique las tres acepciones del reloj.**
Como señal CLK gobierna el ritmo de las instrucciones; como temporizador genera interrupciones periódicas que permiten conmutar entre procesos y tareas del sistema; como RTC es un contador de fecha y hora.

**8. ¿Por qué la jerarquía de memoria tiene varios niveles?**
Porque la memoria de alta velocidad es cara y de tamaño reducido. La jerarquía combina memorias permanentes lentas y de gran capacidad con memorias de semiconductores pequeñas y rápidas, de modo que la mayoría de los accesos se resuelva en los niveles altos.

**9. ¿Qué es un fallo de página y quién lo resuelve?**
La excepción que se produce cuando la página referenciada no está en memoria principal. La resuelve el sistema operativo trayéndola del *swap* con una política de reemplazo; la MMU traduce y la TLB evita acceder a la tabla de páginas en cada traducción.

**10. Distinga programa, proceso e imagen de memoria.**
El programa es un conjunto de instrucciones en un fichero ejecutable; el proceso es ese programa en ejecución, unidad de procesamiento del sistema operativo; la imagen de memoria es el mapa de memoria más la información del proceso (registros, PC, SP y estado) más el BCP.
