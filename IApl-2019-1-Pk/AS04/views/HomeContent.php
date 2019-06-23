<div class="header">
    Parketin
    <div id="logged-email" class="right"></div>
</div>
<div class="sidebar">
    <div class="link-list" link="usage"><?=LANG_TEXT['THEME_USAGE'];?></div>
    <div class="link-list" link="parkinglot"><?=LANG_TEXT['THEME_PARKING_LOT'];?></div>
    <div class="link-list" link="client"><?=LANG_TEXT['THEME_CLIENTS'];?></div>
    <div class="link-list" link="employee"><?=LANG_TEXT['THEME_EMPLOYEES'];?></div>
    <div class="link-list" link="vehicles"><?=LANG_TEXT['THEME_VEHICLES'];?></div>
</div>

<div class="content">
    <form>
        <div class="title">Titulo</div>
        <label>Teste</label>
        <input type="text" placeholder="Teste" />
        <label>Teste</label>
        <select>
            <option>1</option>
            <option>2</option>
        </select>
        <div style="text-align: center;"><button>Submit</button></div>
    </form>

    <div>
        <div class="title"></div>
        <table class="table table-bordered no-more-tables">
            <thead><tr></tr></thead>
            <tbody></tbody>
        </table>
        <br />
        <button id="new"><?=LANG_TEXT['THEME_BTN_ADD_NEW'];?></button>
    </div>
</div>