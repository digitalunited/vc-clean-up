# Visual Composer CleanUp #

##Why?!?
This plugin exist because i got tired of copying my customizations on visual composer to every project. Is allso is meant to solve the issue of maintaing Visual Composer customizations on multiple sites wiuth diffrent requirements.

##How?!?
On activation the plugin creates a file named VcCleanUpConfig.php in your current theme. The file consists of a config-array with the possibility to cleanup Visual Composer without anny manual work.

##Configuration

###enabledStdModules
An array containing all standard modules you want to use. It works as a white list so evertthing thats not declared in this array will disapear from admin.
Values: Array with names of modules you want to keep

###useBootstrapGrid
Replaces "vc_"-prefixed grid-classes with bootstraps grid-classes
Values: true/false

###deregisterFrontendStyles
Disables loading of visualcomposaer css if $param equals true
Values: true/false

###disableFrontendEditor
Disables the frontendeditor
Values: true/false

###removeExtraClassNameField
Removes the "Extra class name"-field on all modules listed in "enabledStdModules"
Values: true/false

###removeDesignOptionsTab
Removes the "Design options"-tab on all modules listed in "enabledStdModules"
Values: true/false

###enableRowLayouts
Removes all row layouts that isn't specified. It uses the rowlayouts titles. 
Values: Array with titles of standard row_layouts, True enables all standard rowlayouts
    
###setVcAsTheme
Set vc as a part of a theme witch disables the "Custom CSS"-tab on the Visual Composer options-page
Values: true/false

###disableGridElements
Removes Grid Elements from the admin menu
Values: true/false

###hideVcAdminButtons
Removes alot of unusefull buttons from VisualComposers admin GUI
Values: true/false

##TODO
- Put the pakage on pagagist
- Add better standard config for the boilerplatefile.