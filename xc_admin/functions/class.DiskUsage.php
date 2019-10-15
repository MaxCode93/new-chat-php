<?php
/**
* Powered By Maxwell
* Package XenCuba v2.1
*/

final class DiskUsage
{
	var $_totalSize = 0;
	var $_totalCount = 0;
	var $_directoryCount = 0;
	var $_handleDir;
	var $_filePath;
	var $_nextPath;
	var $_resultValue;
	var $_totalValue = array();
	
	
	public function _directorySize($_path)
	{
		if($_handleDir = opendir($_path))
		{
			while(FALSE !== ($_filePath = readdir($_handleDir)))
			{
				$_nextPath = $_path . "/" . $_filePath;
				if($_filePath != '.' && $_filePath != '..' && !is_link($_nextPath))
				{
					if(is_dir($_nextPath))
					{
						$_directoryCount++;
						$_resultValue = self::_directorySize($_nextPath);
						$_totalSize += $_resultValue['size'];
						$_totalCount += $_resultValue['count'];
						$_directoryCount += $_resultValue['dircount'];
					}
					elseif(is_file($_nextPath))
					{
						$_totalSize += filesize($_nextPath);
						$_totalCount++;
					}
				}
			}
		}
		closedir($_handleDir);
		$_totalValue['size'] = $_totalSize;
		$_totalValue['count'] = $_totalCount;
		$_totalValue['dircount'] = $_directoryCount;
		
		return $_totalValue;
	}
	
	public function _sizeFormat($_dirSize)
	{
		if($_dirSize < 1024)
		{
			return $_dirSize." Bytes";
		}
		else if($_dirSize < (1024*1024))
    		{
        		$_dirSize = round($_dirSize/1024,1);
        		return $_dirSize." KB";
    		}
    		else if($_dirSize < (1024*1024*1024))
    		{
        		$_dirSize = round($_dirSize/(1024*1024),1);
        		return $_dirSize + 0.1." MB";
    		}
    		else
    		{
        		$_dirSize = round($_dirSize/(1024*1024*1024),1);
        		return $_dirSize." GB";
    		}
	}	
}
?>