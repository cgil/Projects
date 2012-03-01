
function buildMenus() {

	index = 0;
	projects = document.navigation.projects.options;

	projects[index++] = new Option("Main", "");
	projects[index++] = new Option("---------------------", "");
	projects[index++] = new Option("Interfascia Home", "index.htm");
	projects[index++] = new Option("About Interfascia", "about.htm");
	projects[index] = new Option("Installation & Release Notes", "installation.htm");
	
	index = 0;
	sketches = document.navigation.sketches.options;

	sketches[index++] = new Option("Examples", "");
	sketches[index++] = new Option("---------------------", "");
	sketches[index++] = new Option("Button", "examples_button.htm");
	sketches[index++] = new Option("Radio Buttons", "examples_radio.htm");
	sketches[index++] = new Option("Text Field", "examples_textfield.htm");
	sketches[index++] = new Option("", "");
	sketches[index++] = new Option("Custom Widget Color", "examples_custom_color.htm");
	sketches[index] = new Option("Temperature Converter", "examples_convert.htm");
	
	index = 0;
	exhibitions = document.navigation.exhibitions.options;

	exhibitions[index++] = new Option("Documentation", "");
	exhibitions[index++] = new Option("---------------------", "");
	exhibitions[index++] = new Option("GUIController", "guicontroller.htm");
	exhibitions[index++] = new Option("IFRadioController", "ifradiocontroller.htm");
	exhibitions[index++] = new Option("", "");
	exhibitions[index++] = new Option("IFButton", "ifbutton.htm");
	exhibitions[index++] = new Option("IFCheckBox", "ifcheckbox.htm");
	exhibitions[index++] = new Option("IFRadioButton", "ifradiobutton.htm");
	exhibitions[index++] = new Option("IFProgressBar", "ifprogressbar.htm");
	exhibitions[index++] = new Option("IFTextField", "iftextfield.htm");
	exhibitions[index++] = new Option("IFLabel", "iflabel.htm");
	exhibitions[index++] = new Option("", "");
	exhibitions[index++] = new Option("IFLookAndFeel", "iflookandfeel.htm");
	exhibitions[index++] = new Option("", "");
	exhibitions[index++] = new Option("actionPerformed()", "actionperformed.htm");
	exhibitions[index] = new Option("GUIEvent", "guievent.htm");


}

function loadPage(which) {
	n = which.selectedIndex;
	pathArray = location.pathname.split('/');
	page = pathArray[pathArray.length - 1];
	if (which.options[n].value == "" || which.options[n].value == page) {
		which.selectedIndex = 0;
	} else {
		var url = which.options[n].value;
		which.selectedIndex = 0;
		location.href = url;
	}
}
