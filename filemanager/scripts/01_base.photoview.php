<?php
	echo "<?xml version=\"1.0\" encoding=\"UTF8\" ?>\r\n";
	echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\r\n";
?>
<?php
	require('00_prefix.php');
	$myBaseName = basename($myScriptName, '.php');
	$myName = basename($myScriptName, '.php');
?>
<?php include($myName . '.1.inc'); ?>

<onEnter>
	startitem = "middle";
	setRefreshTime(1);

	filterRegExp = "<?php echo $extra; ?>";

	functionSet = 0;
	/* [紅]更新; [綠]複製; [黃]指定複製目的; [藍]切換功能; */
	/* functionSet = 1; */
	/* [紅]執行; [綠]移動; [黃]指定移動目的; [藍]切換功能; */
	/* functionSet = 2; */
	/* [紅]刪除; [綠]改名; [黃]創建新的目錄; [藍]切換功能; */
	/* functionSet = 3; */
	/* [紅]到 usbmounts; [綠]到複製目的; [黃]到移動目的;  [藍]切換功能; */

	userInput = "";
	specialMsg = "";

	inputNumCount = 0;
	inputNumVal = -1;
	curNumVal = -1;

	fileCopyDest = getStoragePath("tmp") + "log.scripts.base.photoview.copyDest.dat";
	copyDest = readStringFromFile(fileCopyDest);
	if (copyDest == null) {
<?php
		if (file_exists("/tmp/usbmounts/share")) {
			echo "\t\tcopyDest = \"/tmp/usbmounts/share\";\r\n";
		}
		else {
			echo "\t\tcopyDest = \"/tmp/usbmounts\";\r\n";
		}
?>
	}
	writeStringToFile(fileCopyDest, copyDest);

	fileMoveDest = getStoragePath("tmp") + "log.scripts.base.photoview.moveDest.dat";
	moveDest = readStringFromFile(fileMoveDest);
	if (moveDest == null) {
<?php
		if (file_exists("/tmp/usbmounts/share")) {
			echo "\t\tmoveDest = \"/tmp/usbmounts/share\";\r\n";
		}
		else {
			echo "\t\tmoveDest = \"/tmp/usbmounts\";\r\n";
		}
?>
	}
	writeStringToFile(fileMoveDest, moveDest);

	fileMkdirDest = getStoragePath("tmp") + "log.scripts.base.photoview.mkdirDest.dat";
	mkdirDest = readStringFromFile(fileMkdirDest);
	if (mkdirDest == null) {
		mkdirDest = "NEW";
	}
	writeStringToFile(fileMkdirDest, mkdirDest);

	fileRenameDest = getStoragePath("tmp") + "log.scripts.base.photoview.renameDest.dat";
	renameDest = readStringFromFile(fileRenameDest);
	if (renameDest == null) {
		renameDest = "NEW";
	}
	writeStringToFile(fileRenameDest, renameDest);
</onEnter>

<onRefresh>
	setRefreshTime(-1);
	itemCount = getPageInfo("itemCount");
</onRefresh>

<mediaDisplay name="photoView"
	viewAreaXPC="0"
	viewAreaYPC="0"
	viewAreaWidthPC="100"
	viewAreaHeightPC="100"
	showDefaultInfo="no"
	itemAlignt="center"
	rowCount="<?php echo $rowCount; ?>"
	columnCount="<?php echo $columnCount; ?>"
	itemWidthPC="<?php echo $itemWidthPC; ?>"
	itemHeightPC="<?php echo $itemHeightPC; ?>"
	itemGapXPC="0"
	itemGapYPC="0"
	showHeader="no"
	centerXPC="5"
	centerYPC="<?php echo $itemYPC; ?>"
	centerWidthPC="100"
	centerHeightPC="100"
	autoSelectItem="yes"
	drawItemBorder="yes"
	itemBackgroundColor="0:0:0"
	backgroundColor="0:0:0"
	itemBorderColor="200:200:0"
>

	<text align="center" fontSize="26"
		offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20"
		backgroundColor="10:105:150" foregroundColor="255:255:255">
		<script>getPageInfo("pageTitle");</script>
	</text>

	<text redraw="yes" fontSize="20"
		offsetXPC="82" offsetYPC="12"
		widthPC="20" heightPC="6"
		backgroundColor="10:105:150" foregroundColor="255:255:255">
		<script>sprintf("%s / <?php echo $itemTotal; ?>", 1+focus);</script>
	</text>
		<!--<script>sprintf("%s / ", focus-(-1))+itemCount;</script>-->

	<image redraw="no"
		offsetXPC="5" offsetYPC="2.5"
		widthPC="15" heightPC="15"
		backgroundColor="-1:-1:-1">
		<script>
			print(imgLeftTop);
			imgLeftTop;
		</script>
	</image>

	<text redraw="yes" align="left"
		fontSize="<?php echo $fontSizeHint; ?>" lines="1"
		offsetXPC="0" offsetYPC="<?php echo ($itemYPC+($rowCount*$itemHeightPC)+$statusAdjYPC); ?>"
		widthPC="100" heightPC="<?php echo ($itemHeightPC+$statusAdjHeightPC); ?>"
		backgroundColor="0:0:0" foregroundColor="255:255:0">
		<script>
			userInput = currentUserInput();
			if ((inputNumCount == 0) ||
					((inputNumCount == <?php echo (floor(log10($itemTotal)) + 1);?>) &amp;&amp;
					((curNumVal &lt; 1) || (curNumVal &gt; itemCount)))) {
				if (functionSet == 0)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]更新; [綠]複製; [黃]指定複製目的; [藍]切換功能; [數字鍵直選]; {" + userInput + "}";
				else if (functionSet == 1)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]執行; [綠]移動; [黃]指定移動目的; [藍]切換功能; [數字鍵直選]; {" + userInput + "}";
				else if (functionSet == 2)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]刪除; [綠]改名; [黃]創建新的目錄; [藍]切換功能; [數字鍵直選]; {" + userInput + "}";
				else
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]到 usbmounts; [綠]到複製目的; [黃]到移動目的; [藍]切換功能; [數字鍵直選]; {" + userInput + "}";
			}
			else {
				if (functionSet == 0)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]更新; [綠]複製; [黃]指定複製目的; [藍]切換功能; 第 " + curNumVal + " 項; {" + userInput + "}";
				else if (functionSet == 1)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]執行; [綠]移動; [黃]指定移動目的; [藍]切換功能; 第 " + curNumVal + " 項; {" + userInput + "}";
				else if (functionSet == 2)
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]刪除; [綠]改名; [黃]創建新的目錄; [藍]切換功能; 第 " + curNumVal + " 項; {" + userInput + "}";
				else
					str = "[方向鍵]; [上下頁]最前後; [確定]檢視; [放大]進目錄; [紅]到 usbmounts; [綠]到複製目的; [黃]到移動目的; [藍]切換功能; 第 " + curNumVal + " 項; {" + userInput + "}";
			}
			print(str);
			str;
		</script>
	</text>

	<text redraw="yes" align="<?php echo $statusAlign; ?>" lines="<?php echo $statusLines; ?>"
		fontSize="<?php echo $fontSizeStatus; ?>"
		offsetXPC="0" offsetYPC="90"
		widthPC="100" heightPC="4"
		backgroundColor="10:105:150" foregroundColor="255:255:255">
		<script>
			"完整徑名資料: " + fullnameData + specialMsg;
		</script>
		<foregroundColor>
			<script>
				if (specialMsg == "")
					"255:255:255";
				else
					"255:0:0";
			</script>
		</foregroundColor>
	</text>

	<text redraw="yes" align="<?php echo $statusAlign; ?>" lines="<?php echo $statusLines; ?>"
		fontSize="<?php echo $fontSizeStatus; ?>"
		offsetXPC="0" offsetYPC="94"
		widthPC="100" heightPC="4"
		backgroundColor="10:105:150" foregroundColor="255:255:255">
		<script>
			"目前位置: [" + currDir + "]{" + filterRegExp + "}; 複製目的: [" + copyDest + "]; 移動目的: [" + moveDest + "]";
		</script>
	</text>

	<idleImage>image/<?php echo $idleImagePrefix; ?>1.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>2.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>3.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>4.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>5.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>6.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>7.png</idleImage>
	<idleImage>image/<?php echo $idleImagePrefix; ?>8.png</idleImage>

	<itemDisplay>
		<text align="left" lines="1"
			offsetXPC="0" offsetYPC="0"
			widthPC="100" heightPC="100">
			<script>
				idx = getQueryItemIndex();
				focus = getFocusItemIndex();
				if(focus == idx) {
					currDir  = getItemInfo(idx, "note");
					fullnameData = getItemInfo(idx, "site_link") + " -- " + getItemInfo(idx, "data");
					img = getItemInfo(idx, "image");
					if (img == null) {
						img = "<?php echo myImage($myBaseName); ?>";
					}
					imgLeftTop = getItemInfo(idx, "channelImage");
					if (imgLeftTop == null) {
						imgLeftTop = "<?php echo myImage($myBaseName); ?>";
					}
				}

				/* Because there seems no loop construct... */
				strItemTitle = "" + Add(idx, 1) + ":　" + getItemInfo(idx, "title");
				maxDigits    = <?php echo (floor(log10($itemTotal)) + 1); ?>;
				numBoundary  = 9;
				if ((maxDigits &gt; 1) &amp;&amp; (idx &lt; numBoundary)) {
					strItemTitle = "0" + strItemTitle;
				}
				maxDigits -= 1;
				numBoundary = (10 * numBoundary) + 9;
				if ((maxDigits &gt; 1) &amp;&amp; (idx &lt; numBoundary)) {
					strItemTitle = "0" + strItemTitle;
				}
				maxDigits -= 1;
				numBoundary = (10 * numBoundary) + 9;
				if ((maxDigits &gt; 1) &amp;&amp; (idx &lt; numBoundary)) {
					strItemTitle = "0" + strItemTitle;
				}
				maxDigits -= 1;
				numBoundary = (10 * numBoundary) + 9;
				if ((maxDigits &gt; 1) &amp;&amp; (idx &lt; numBoundary)) {
					strItemTitle = "0" + strItemTitle;
				}
				strItemTitle;
			</script>
			<fontSize>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "<?php echo $fontSizeText; ?>";
					else "<?php echo $fontSizeText; ?>";
				</script>
			</fontSize>
			<backgroundColor>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "10:105:150";
					else "0:0:0";
				</script>
			</backgroundColor>
			<foregroundColor>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "255:255:255";
					else "140:140:140";
				</script>
			</foregroundColor>
		</text>
	</itemDisplay>

	<onUserInput>
		<script>
			ret = "false";
			userInput  = currentUserInput();
			specialMsg = "";

			if (
				(userInput == "zoom") ||
				(userInput == "option_red") ||
				(userInput == "option_green") ||
				(userInput == "option_yellow") ||
				(userInput == "option_blue") ||
				(userInput == "pagedown") ||
				(userInput == "pageup") ||
				(userInput == "one") ||
				(userInput == "two") ||
				(userInput == "three") ||
				(userInput == "four") ||
				(userInput == "five") ||
				(userInput == "six") ||
				(userInput == "seven") ||
				(userInput == "eight") ||
				(userInput == "nine") ||
				(userInput == "zero")
			) {
				idx = Integer(getFocusItemIndex());
				goItemIndex = idx;
				fileGoItem  = getStringArrayAt(fileArray, goItemIndex);
				if (userInput == "zoom") {
					/* [放大]進目錄 */
					jumpToLink("chdirItem");
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "option_red") {
					/* 0: [紅]更新; */
					/* 1: [紅]執行; */
					/* 2: [紅]刪除; */
					/* 3: [紅]到 usbmounts; */
					if (functionSet == 0) {
						jumpToLink("refreshItem");
					}
					else if (functionSet == 1) {
						if ((fileGoItem != ".") &amp;&amp; (fileGoItem != "..")) {
							jumpToLink("runItem");
						}
						else {
							specialMsg = " --- 無效的指令: 執行";
						}
					}
					else if (functionSet == 2) {
						if ((fileGoItem != ".") &amp;&amp; (fileGoItem != "..")) {
							jumpToLink("deleteItem");
						}
						else {
							specialMsg = " --- 無效的指令: 刪除";
						}
					}
					else {
						jumpToLink("goUsbMountsItem");
					}
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "option_green") {
					/* 0: [綠]複製; */
					/* 1: [綠]移動; */
					/* 2: [綠]改名; */
					/* 3: [綠]到複製目的; */
					if (functionSet == 0) {
						if ((fileGoItem != ".") &amp;&amp; (fileGoItem != "..")) {
							jumpToLink("copyItem");
						}
						else {
							specialMsg = " --- 無效的指令: 複製";
						}
					}
					else if (functionSet == 1) {
						if ((fileGoItem != ".") &amp;&amp; (fileGoItem != "..")) {
							jumpToLink("moveItem");
						}
						else {
							specialMsg = " --- 無效的指令: 移動";
						}
					}
					else if (functionSet == 2) {
						if ((fileGoItem != ".") &amp;&amp; (fileGoItem != "..")) {
							renameDest = doModalRss("rss_file://./etc/ypInput/ypKeyboard.rss", "mediaDisplay", "search", 0);
							writeStringToFile(fileRenameDest, renameDest);
							if (renameDest != null) {
								jumpToLink("renameItem");
							}
						}
						else {
							specialMsg = " --- 無效的指令: 改名";
						}
					}
					else {
						jumpToLink("goCopyDestItem");
					}
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "option_yellow") {
					/* 0: [黃]指定複製目的; */
					/* 1: [黃]指定移動目的; */
					/* 2: [黃]創建新的目錄; */
					/* 3: [黃]到移動目的; */
					if (functionSet == 0) {
						copyDest = getStringArrayAt(fullnameArray, idx);
						writeStringToFile(fileCopyDest, copyDest);
					}
					else if (functionSet == 1) {
						moveDest = getStringArrayAt(fullnameArray, idx);
						writeStringToFile(fileMoveDest, moveDest);
					}
					else if (functionSet == 2) {
						mkdirDest = doModalRss("rss_file://./etc/ypInput/ypKeyboard.rss", "mediaDisplay", "search", 0);
						writeStringToFile(fileMkdirDest, mkdirDest);
						if (mkdirDest != null) {
							jumpToLink("mkdirItem");
						}
					}
					else {
						jumpToLink("goMoveDestItem");
					}
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "option_blue") {
					/* [藍]切換功能; */
					if (functionSet == 0)
						functionSet = 1;
					else if (functionSet == 1)
						functionSet = 2;
					else if (functionSet == 2)
						functionSet = 3;
					else
						functionSet = 0;
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "pagedown") {
					idx = itemCount-1;
				}
				else if (userInput == "pageup") {
					idx = 0;
				}
				else {
					if (userInput == "one") {
						inputNumVal = 1;
					}
					else if (userInput == "two") {
						inputNumVal = 2;
					}
					else if (userInput == "three") {
						inputNumVal = 3;
					}
					else if (userInput == "four") {
						inputNumVal = 4;
					}
					else if (userInput == "five") {
						inputNumVal = 5;
					}
					else if (userInput == "six") {
						inputNumVal = 6;
					}
					else if (userInput == "seven") {
						inputNumVal = 7;
					}
					else if (userInput == "eight") {
						inputNumVal = 8;
					}
					else if (userInput == "nine") {
						inputNumVal = 9;
					}
					else if (userInput == "zero") {
						inputNumVal = 0;
					}

					if ((inputNumCount == 0) || (inputNumCount == <?php echo (floor(log10($itemTotal)) + 1);?>)) {
						inputNumCount = 1;
						curNumVal = inputNumVal;
					}
					else {
						inputNumCount = inputNumCount + 1;
						curNumVal = (10*curNumVal) + inputNumVal;
					}

					if ((curNumVal &gt;= 1) &amp;&amp; (curNumVal &lt;= itemCount)) {
						idx = (curNumVal - 1);
					}
					else if ((inputNumVal &gt;= 1) &amp;&amp; (inputNumVal &lt;= itemCount)) {
						/* Keep the last digit which makes the value out of range unless invalid */
						inputNumCount = 1;
						curNumVal = inputNumVal;
						idx = (curNumVal - 1);
					}
					else {
						inputNumCount = 0;
						inputNumVal = -1;
						curNumVal = -1;
					}
				}
				print("new idx: "+idx);
				setFocusItemIndex(idx);
				setItemFocus(0);
				ret = "true";
			}
			redrawDisplay();
			ret;
		</script>
	</onUserInput>
</mediaDisplay>

<?php include($myName . '.2.inc'); ?>

</rss>
<?php
	require('00_suffix.php');
?>
