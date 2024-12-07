<!--
    From Uiverse.io by satyamchaudharydev 
    topa isa magandaaaaa
-->
 
<button class="appLogo scale-75" data-text="Awesome" onclick="window.location.href='{{ url('/') }}'">
    <span class="actual-text">&nbsp;Paws   &nbsp;</span>
    <span aria-hidden="true" class="hover-text">&nbsp;Claws&nbsp;</span>
</button>

<style>
    /* From Uiverse.io by satyamchaudharydev */ 
    /* === removing default button style ===*/
    .appLogo {
        margin: 0;
        height: auto;
        background: transparent;
        padding: 0;
        border: none;
        cursor: pointer;
    }

    /* button styling */
    .appLogo {
        --border-right: 6px;
        --animation-color: #582bab;
        --fs-size: 2em;
        letter-spacing: 3px;
        text-decoration: none;
        font-size: var(--fs-size);
        font-family: "Arial";
        position: relative;
        text-transform: uppercase;
        -webkit-text-stroke: 1px var(--text-stroke-color);
    }
    /* this is the text, when you hover on button */
    .appLogo .hover-text {
        position: absolute;
        box-sizing: border-box;
        content: attr(data-text);
        color: var(--animation-color);
        width: 0%;
        inset: 0;
        border-right: var(--border-right) solid var(--animation-color);
        overflow: hidden;
        transition: 0.5s;
        -webkit-text-stroke: 1px var(--animation-color);
    }
        /* hover */
        .appLogo:hover .hover-text {
        width: 105%;
        filter: drop-shadow(0 0 24px var(--animation-color))
    }
    .appLogo .actual-text {
        position: relative;
        display: inline-block;
        white-space: nowrap;
        opacity: 1;
        transition: opacity 0.3s ease-in-out;
        transform: translateX(0);
    }
    .appLogo:hover .actual-text{
        opacity: 0;
        transform: translateX(100%);
        transition: opacity 0.3s ease-in-out, transform 0.3s ease-in-out;
    }
</style>