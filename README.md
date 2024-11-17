# phpBB-Collapse-Quote

## Description
If quotes are very long, the box is displayed in a smaller size. A mouse click displays the entire quote.

#### Settings in User Control Panel > Board preferences > Edit display options
- Collapse Quote enable/disable.
- Number of visible lines.
- Text alignment in quotebox.

#### Settings in Administration Control Panel
- Settings for guests and new user.
  - Collapse Quote enable/disable.
  - Number of visible lines.
  - Text alignment in quotebox.
- expand/collapse button colours.
- Settings from the UCP are available in the user administration

## Screenshots
- [ACP](https://raw.githubusercontent.com/IMC-GER/images/main/screenshots/collapsequote/en/screenshot_collapse_quote_acp.png)
- [UCP](https://raw.githubusercontent.com/IMC-GER/images/main/screenshots/collapsequote/en/screenshot_collapse_quote_ucp.png)
- [Post Quote is collapse](https://raw.githubusercontent.com/IMC-GER/images/main/screenshots/collapsequote/en/screenshot_collapse_quote_collaps.png)
- [Post Quote is expand](https://raw.githubusercontent.com/IMC-GER/images/main/screenshots/collapsequote/en/screenshot_collapse_quote_expand.png)

## Requirements
- php 7.0 or higher
- phpBB 3.2.0 or higher

## Installation
- Copy the extension to `phpBB3/ext/imcger/collapsequote`.
- Go to "ACP" > "Customise" > "Manage extensions" and enable the "Collapse Quote" extension.

## Update
- Navigate in the ACP to `Customise -> Manage extensions`.
- Click the `Disable` link for "Collapse Quote".
- Delete the `collapsequote` folder from `phpBB3/ext/imcger/`.
- Copy the extension to `phpBB3/ext/imcger/collapsequote`.
- Go to "ACP" > "Customise" > "Manage extensions" and enable the "Collapse Quote" extension.

## Changelog

### v1.4.0 (17-11-2024) 
- Fixed Don't set default data for guest when board email ist deactive
- Changed Used only one template for user settings in UCP, ACP and user administrations panele
- Changed Minimum number of visible lines
- Changed Language vars renamed
- Changed Template vars renamed
- Changed The texts of the language files have been adapted
- Changed Requirements phpBB min. 3.3.0 and php max. 8.3
- Removed Redundant columen with user data in db config table
- Removed Language file common.php
- Added LukeWCSphpBBConfirmBox v1.4.3
- Added Twig macro for colpick input field
- Added User settings to ACP user administration

### v1.3.2 (03-03-2024) 
- Fixed JS error when element undefined

### v1.3.1 (21-02-2024) 
- Fixed don't toggle quotebox with nested quoteboxes

### v1.3.0 (21-02-2024) 
- Fixed don't set default userdata for guest
- Changed JS code to class
- Changed security question in ACP to LukeWCSphpBBConfirmBox
- Revised language variables
- Added: Works also in preview and pm now

### v1.2.1 (05-06-2023) 
- Fixed shadow overlaps dropdown menu

### v1.2.0 (28-05-2023) 
- Added settings in UCP.
  - Collapse Quote enable/disable.
  - Number of visible lines.
  - Text alignment in quotebox.
- Added collapse Quote enable/disable.
- Added text alignment in quotebox top/bottom.
- Changed php min to 7.0

### v1.1.2 (28-06-2022) 
- Check system requirement
- Controller for ACP template
- Deprecated function removed

### v1.1.1 (10-06-2022)
- Bug in migration
 
### v1.1.0 (07-06-2022)
- Minore code change
- Hover effect for togglebutton
- Bug: ACP select foreground color

### v1.0.1 (19-05-2022)
- Bug: ACP display error

### v1.0.0 (17-05-2022)
- If the upper part of the quote box is outside the viewport, scroll it to top position wenn collapse.
- Language adjustments
- Add version check

### v0.4.2 (19-03-2022)
- Cleanup code

### v0.4.1 (01-02-2022)
- Minore code change

### v0.4.0 (31-01-2022)
- Language support
- Settings in ACP

### v0.3.0 (20-01-2022)
- Minor code changes
- Adjust Quotebox when window resize

### v0.2.0 (19-01-2022)
- Code changes
- Add animation

### v0.1.0 (16-01-2022)

## Uninstallation
- Navigate in the ACP to `Customise -> Manage extensions`.
- Click the `Disable` link for "Collapse Quote".
- To permanently uninstall, click `Delete Data`, then delete the `collapsequote` folder from `phpBB3/ext/imcger/`.

## License
[GPLv2](https://www.gnu.org/licenses/old-licenses/gpl-2.0.en.html)
