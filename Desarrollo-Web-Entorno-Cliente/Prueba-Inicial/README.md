# Prueba-Inicial (DWEC)

Ejercicio: formulario en `index.html` que calcula el IVA a partir de un precio base.

- Campo numérico para el **precio base**.
- Selector `<select>` con los tipos de IVA: General (21%), Reducido (10%) y Superreducido (4%).
- Botón **Calcular** que lee los valores con JavaScript, valida que el precio sea un número mayor que cero (aviso en rojo si no lo es) e inyecta el desglose en la página sin recargarla.
- Incluye `console.log` de los cálculos intermedios y una línea `debugger` comentada para depurar con las DevTools (F12).
- Un contenedor(<div> o <p>) donde se mostrata el desglose
