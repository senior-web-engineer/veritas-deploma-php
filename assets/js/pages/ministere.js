'use strict';

function ministereAfterAjax(run,options)
{
	run = $j.str_replace('#','',run);
    options = options || {};

	switch(run)
	{
		case 'verification':
			saving('form_verification', 6, 'result')
		break;
	}
}
