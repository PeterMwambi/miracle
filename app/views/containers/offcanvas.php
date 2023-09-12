<?php

$offCanvasItems = [
    "items" => [
        "Dashboard",
        "Todo",
        "Notifications",
        "Messages",
        "Properties",
        "Tenants",
        "Payments",
        "Invoice",
        "Receipts",
        "Reports",
        "Package",
        "Occupation Notice",
        "Vacation Notice",
        "Settings",
        "Profile",
        "Log out",
        "Close"
    ],
    "icons" => [
        "Dashboard" => "assets/ui/dashboard.png",
        "Todo" => "assets/ui/todo.png",
        "Notifications" => "assets/ui/notifications.png",
        "Messages" => "assets/ui/messaging.png",
        "Properties" => "assets/ui/properties.png",
        "Tenants" => "assets/ui/tenants.png",
        "Payments" => "assets/ui/payments.png",
        "Invoice" => "assets/ui/invoice.png",
        "Receipts" => "assets/ui/receipts.png",
        "Reports" => "assets/ui/reports.png",
        "Package" => "assets/ui/package.png",
        "Occupation Notice" => "assets/ui/occupation.png",
        "Vacation Notice" => "assets/ui/vacation.png",
        "Settings" => "assets/ui/services.png",
        "Profile" => "assets/ui/profile.png",
        "Log out" => "assets/ui/switch.png",
        "Close" => "assets/ui/close.png"
    ],
];


?>
<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="dpz__sidenavbar"
    aria-labelledby="dpz__sideNavbar">
    <div class="offcanvas-header d-block">
        <div class="d-flex justify-content-end">
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="close"></button>
        </div>
        <div class="">
            <div class="d-flex justify-content-center">
                <img src="<?php asset("assets/logo/rmis.png") ?>" class="img-fluid dpz__logo">
            </div>
        </div>
    </div>
    <hr>
    <div class="offcanvas-body ms-3">
        <?php foreach ($offCanvasItems["items"] as $item) { ?>
            <div class="d-flex my-3">
                <div>
                    <img src="<?php echo asset($offCanvasItems["icons"][$item]) ?>" class="img-fluid icon-sm mb-2">
                </div>
                <div>
                    <a class="ms-1 nav-link">
                        <?php echo $item; ?>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</div>