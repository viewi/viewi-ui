# Button component

```html
<Btn>My Button</Btn>

With click event:
<Btn (click)="onClick($event)">My Button</Btn>

Disabled:
<Btn disabled="true">My Button</Btn>

Depressed: 
<Btn depressed="true">My Button</Btn>

Link: 
<Btn href="/icons">Link to icons</Btn>

Icon button: 
<Btn icon="true">
    <Icon name="mdi-heart" />
</Btn>

Block: 
<Btn block="true">My Button</Btn>

Elevated (1-24):
<Btn elevation="4">My Button</Btn>

Sizing:
<Btn size="xsmall">xsmall</Btn>
<Btn size="small">small</Btn>
<Btn>normal</Btn>
<Btn size="large">large</Btn>
<Btn size="xlarge">xlarge</Btn>

Loading state:
<Btn loading="true">Load data</Btn>

Colors:
<Btn color="success">success</Btn>
<Btn color="primary">primary</Btn>
<Btn color="secondary">secondary</Btn>
<Btn color="accent">accent</Btn>
<Btn color="error">error</Btn>
<Btn color="warning">warning</Btn>
<Btn color="tertiary">tertiary</Btn>
<Btn color="info">info</Btn>

Outlined:
<Btn outlined="true">Outlined</Btn>

Plain:
<Btn plain="true">Plain</Btn>

Text:
<Btn text="true">Text</Btn>

Tile:
<Btn tile="true">Tile</Btn>

Rounded:
<Btn rounded="true">Rounded</Btn>

Pill:
<Btn pill="true">X</Btn>


With icons:
<Btn>Decline
    <Icon name="mdi-cancel" position="right" />
</Btn>
<Btn>
    <Icon name="mdi-minus-circle" position="left" />Cancel
</Btn>
<Btn>
    <Icon name="mdi-cloud-upload" />
</Btn>

Absolute / Fixed:
<Btn absolute="true" top="true" right="true">
    Absolute top right
</Btn>
<Btn fixed="true" bottom="true" right="true">
    Fixed bottom right
</Btn>

Combinations:
<Btn (click)="onClick($event)" color="primary" size="xsmall" pill="true">X</Btn>
<Btn (click)="onClick($event)" color="success" size="small" pill="true" tile="true">S</Btn>
<Btn (click)="onClick($event)" color="warning">normal</Btn>
<Btn (click)="onClick($event)" color="primary" size="large">large</Btn>
<Btn (click)="onClick($event)" color="error" size="xlarge" pill="true" tile="true" outlined="true">X</Btn>
```

