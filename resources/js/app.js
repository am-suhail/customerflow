require("./bootstrap");
import Alpine from "alpinejs";
import Focus from "@alpinejs/focus";
import intlTelInput from "intl-tel-input";

import FormsAlpinePlugin from "../../vendor/filament/forms/dist/module.esm";
import NotificationsAlpinePlugin from "../../vendor/filament/notifications/dist/module.esm";

Alpine.plugin(Focus);
Alpine.plugin(FormsAlpinePlugin);
Alpine.plugin(NotificationsAlpinePlugin);

window.intlTelInput = intlTelInput;

window.Alpine = Alpine;
Alpine.start();
