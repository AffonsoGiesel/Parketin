<div class="header">
    Parketin
    <div id="logged-email" class="right"></div>
</div>
<div class="sidebar">
    <div class="link-list" link="usage"><?=LANG_TEXT['THEME_USAGE'];?></div>
    <div class="link-list" link="parkinglot"><?=LANG_TEXT['THEME_PARKING_LOT'];?></div>
    <div class="link-list" link="employee"><?=LANG_TEXT['THEME_EMPLOYEES'];?></div>
    <div class="link-list" link="client"><?=LANG_TEXT['THEME_CLIENTS'];?></div>
    <div class="link-list" link="vehicle"><?=LANG_TEXT['THEME_VEHICLES'];?></div>
    <div class="link-list" link="login"><?=LANG_TEXT['THEME_LOGIN'];?></div>
</div>

<div class="content">
    <form id="newRecord">
        <div class="title"><?=LANG_TEXT['THEME_NEW_RECORD'];?></div>
        <div class="inputGroup"></div>
        <div style="text-align: center;"><button><?=LANG_TEXT['THEME_CREATE_RECORD'];?></button></div>
    </form>
    <form id="updateRecord">
        <div class="title"><?=LANG_TEXT['THEME_UPDATE_RECORD'];?></div>
        <div class="inputGroup"></div>
        <div style="text-align: center;"><button id="update"><?=LANG_TEXT['THEME_SAVE_RECORD'];?></button></div>
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