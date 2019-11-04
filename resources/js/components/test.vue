<template>
  <div id="app">
    <h1>
      vue-simple-alert examples
      <small>({{ v }})</small>
    </h1>
    <br />
    <h2>Alert examples</h2>
    <div id="examples">
      <div id="alert-example">
        <button @click="alertExample0" type="button">Normal Alert</button>
        <button @click="alertExample1" type="button" class="swal2-confirm swal2-styled">Simple</button>
        <button @click="alertExample2" type="button" class="swal2-confirm swal2-styled">With title</button>
        <button @click="alertExample3" type="button" class="swal2-confirm swal2-styled">Success icon</button>
        <button @click="alertExample4" type="button" class="swal2-confirm swal2-styled">Warning icon</button>
      </div>

      <br />
      <h2>Confirm examples</h2>
      <div id="confirm-example">
        <button @click="confirmExample0" type="button">Normal Confirm</button>
        <button @click="confirmExample1" type="button" class="swal2-confirm swal2-styled">Simple</button>
        <button
          @click="confirmExample2"
          type="button"
          class="swal2-confirm swal2-styled"
        >Question icon</button>
        <button @click="confirmExample3" type="button" class="swal2-confirm swal2-styled">Error icon</button>
        <button
          @click="confirmExample4"
          type="button"
          class="swal2-confirm swal2-styled"
        >Reverse buttons</button>
      </div>

      <br />
      <h2>Prompt examples</h2>
      <div id="prompt-example">
        <button @click="promptExample0" type="button">Normal Prompt</button>
        <button
          @click="promptExample1"
          type="button"
          class="swal2-confirm swal2-styled"
        >Simple Prompt</button>
        <button
          @click="promptExample2"
          type="button"
          class="swal2-confirm swal2-styled"
        >Question icon</button>
        <button
          @click="promptExample3"
          type="button"
          class="swal2-confirm swal2-styled"
        >Reverse buttons</button>
      </div>

      <br />
      <h2>Advanced examples</h2>
      <div id="advanced-example">
        <button
          @click="advancedExample"
          type="button"
          class="swal2-confirm swal2-styled"
        >Advanced Example</button>
      </div>
    </div>
  </div>
</template>