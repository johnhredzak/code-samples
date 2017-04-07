// File: capasso.js
// Description: JavaScript functions for capassorenovations.com

//////////// function WriteEmailLink ////////////
// Writes an e-mail link, inline, in a HTML document.
// Use this to avoid detection by web crawlers.
//
// Code to appear in calling document:
// <scr ipt type="text/javascript" language="JavaScript">{WriteEmailLink("user", "domain", "tld");}</scr ipt>
// Input args: recipient_name, domain, top_level_domain.
//
function WriteEmailLink(usr, dom, tld)
{
document.write('<a href="mailto:' + usr + '@' + dom + '.' + tld + '">' + usr + '@' + dom + '.' + tld + '</a>');
}
//////////// END function WriteEmailLink ////////////
