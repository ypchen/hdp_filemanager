<?php
	echo "<?xml version=\"1.0\" encoding=\"UTF8\" ?>\r\n";
	echo "<rss version=\"2.0\" xmlns:dc=\"http://purl.org/dc/elements/1.1/\">\r\n";
?>
<?php
	require('00_prefix.php');
	$myName = basename($myScriptName, '.php');
	$myBaseName = basename($myName, '.query');
?>
<?php
	include($myName . '.1.inc');

	// Default display parameters
	if (!isset($themeMainForegroundColor)) $themeMainForegroundColor = '255:255:255';
	if (!isset($themeMainBackgroundColor)) $themeMainBackgroundColor = '150:10:105';
	if (!isset($themeTextForegroundColor)) $themeTextForegroundColor = '255:255:255';
	if (!isset($themeTextBackgroundColor)) $themeTextBackgroundColor = '0:0:0';
	if (!isset($themeTipsForegroundColor)) $themeTipsForegroundColor = '255:255:0';
	if (!isset($themeTipsBackgroundColor)) $themeTipsBackgroundColor = $themeTextBackgroundColor;
	if (!isset($themeItemForegroundColorFocused)) $themeItemForegroundColorFocused = $themeTextForegroundColor;
	if (!isset($themeItemBackgroundColorFocused)) $themeItemBackgroundColorFocused = $themeMainBackgroundColor;
	if (!isset($themeItemForegroundColorUnfocused)) $themeItemForegroundColorUnfocused = '140:140:140';
	if (!isset($themeItemBackgroundColorUnfocused)) $themeItemBackgroundColorUnfocused = $themeTextBackgroundColor;
	if (!isset($themeItemFontSizeFocused)) $themeItemFontSizeFocused = '12';
	if (!isset($themeItemFontSizeUnfocused)) $themeItemFontSizeUnfocused = $themeItemFontSizeFocused;
	if (!isset($themeTipsFontSize)) $themeTipsFontSize = '12';

	// Create my own link
	$params  = str_replace('&', '&amp;', $_SERVER['QUERY_STRING']);
	$currUrl = $scriptsURLprefix . '/' . $myName . '.php?' . $params;
?>

<onEnter>
	focus = 0;
	userInput = "";

	inputNumCount = 0;
	inputNumVal = -1;
	curNumVal = -1;

	/* Static items */
	itemCount = getPageInfo("itemCount");
	setRefreshTime(200);

	x = itemCount;
	<?php include('00_utils.digits.inc'); ?>
	itemCountDigits = y;
</onEnter>

<onRefresh>
	setRefreshTime(-1);
	itemCount = getPageInfo("itemCount");
	x = itemCount;
	<?php include('00_utils.digits.inc'); ?>
	itemCountDigits = y;
	redrawDisplay();
</onRefresh>

<mediaDisplay name="threePartsView"
	sideLeftWidthPC="0"
	sideRightWidthPC="0"
	headerImageWidthPC="0"
	selectMenuOnRight="no"
	autoSelectMenu="no"
	autoSelectItem="no"
	itemImageHeightPC="0"
	itemImageWidthPC="0"
	itemXPC="<?php echo $itemXPC; ?>"
	itemYPC="<?php echo $itemYPC; ?>"
	itemWidthPC="<?php echo $itemWidthPC; ?>"
	itemHeightPC="<?php echo $itemHeightPC; ?>"
	capXPC="<?php echo $itemXPC; ?>"
	capYPC="<?php echo $itemYPC; ?>"
	capWidthPC="<?php echo $itemWidthPC; ?>"
	capHeightPC="64"
	itemBackgroundColor="0:0:0"
	itemPerPage="<?php echo $itemPerPage; ?>"
	itemGap="0"
	bottomYPC="90"
	backgroundColor="0:0:0"
	showHeader="no"
	showDefaultInfo="no"
	imageFocus=""
	sliding="no"
	idleImageWidthPC="10"
	idleImageHeightPC="10"
>
	<image redraw="no"
		offsetXPC="5" offsetYPC="2.5"
		widthPC="15" heightPC="15"
		backgroundColor="-1:-1:-1">
		<script>
			imgLeftTop;
		</script>
	</image>

	<text align="center" fontSize="26"
		offsetXPC="0" offsetYPC="0" widthPC="100" heightPC="20"
		backgroundColor="<?php echo $themeMainBackgroundColor; ?>"
		foregroundColor="<?php echo $themeMainForegroundColor; ?>">
		<script>
			getPageInfo("pageTitle");
		</script>
	</text>

	<text redraw="yes" fontSize="20"
		offsetXPC="82" offsetYPC="12"
		widthPC="20" heightPC="6"
		backgroundColor="<?php echo $themeMainBackgroundColor; ?>"
		foregroundColor="<?php echo $themeMainForegroundColor; ?>">
		<script>
			"" + Add(focus, 1) + " / " + itemCount;
		</script>
	</text>

	<text redraw="no" align="left"
		fontSize="<?php echo $themeTipsFontSize; ?>" lines="1"
		offsetXPC="0" offsetYPC="<?php echo ($itemYPC+($rowCount*$itemHeightPC)+$statusAdjYPC); ?>"
		widthPC="100" heightPC="<?php echo ($itemHeightPC+$statusAdjHeightPC); ?>"
		backgroundColor="<?php echo $themeTipsBackgroundColor; ?>"
		foregroundColor="<?php echo $themeTipsForegroundColor; ?>">
		<script>
			userInput = currentUserInput();
			if ((inputNumCount == 0) ||
					((inputNumCount == itemCountDigits) &amp;&amp;
					((curNumVal &lt; 1) || (curNumVal &gt; itemCount)))) {
				str = "[↕]±1; [↔]±<?php echo $itemPerPage; ?>; [上下頁]最前後; [紅]更新內容/重覆執行; [數字鍵直選]; {" + userInput + "}";
			}
			else {
				str = "[↕]±1; [↔]±<?php echo $itemPerPage; ?>; [上下頁]最前後; [紅]更新內容/重覆執行; 第 " + curNumVal + " 項; {" + userInput + "}";
			}
			str;
		</script>
	</text>

	<text redraw="yes" align="<?php echo $statusAlign; ?>" lines="<?php echo $statusLines; ?>"
		fontSize="<?php echo $themeTipsFontSize; ?>"
		offsetXPC="0" offsetYPC="90"
		widthPC="100" heightPC="8"
		backgroundColor="<?php echo $themeMainBackgroundColor; ?>"
		foregroundColor="<?php echo $themeMainForegroundColor; ?>">
		<script>
			itemTitle;
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
					itemTitle  = getItemInfo(idx, "title");
					noteOne    = getItemInfo(idx, "note_one");
					noteTwo    = getItemInfo(idx, "note_two");
					noteThree  = getItemInfo(idx, "note_three");
					noteFour   = getItemInfo(idx, "note_four");
					img        = getItemInfo(idx, "image");
					if (img == null) {
						img = "<?php echo myImage($myBaseName); ?>";
					}
					imgLeftTop = getItemInfo(idx, "channelImage");
					if (imgLeftTop == null) {
						imgLeftTop = "<?php echo myImage($myBaseName); ?>";
					}
				}

				strItemTitle = "" + Add(idx, 1) + ":　" + getItemInfo(idx, "title");
				numBoundary  = 9;
				maxDigits    = itemCountDigits;
				if (maxDigits &lt; 2) maxDigits = 2;
				while (maxDigits &gt; 1) {
					if (idx &lt; numBoundary) {
						strItemTitle = "0" + strItemTitle;
					}
					numBoundary = (10 * numBoundary) + 9;
					maxDigits -= 1;
				}
				strItemTitle;
			</script>
			<fontSize>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "<?php echo $themeItemFontSizeFocused; ?>";
					else "<?php echo $themeItemFontSizeUnfocused; ?>";
				</script>
			</fontSize>
			<foregroundColor>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "<?php echo $themeItemForegroundColorFocused; ?>";
					else "<?php echo $themeItemForegroundColorUnfocused; ?>";
				</script>
			</foregroundColor>
			<backgroundColor>
				<script>
					idx = getQueryItemIndex();
					focus = getFocusItemIndex();
					if(focus == idx) "<?php echo $themeItemBackgroundColorFocused; ?>";
					else "<?php echo $themeItemBackgroundColorUnfocused; ?>";
				</script>
			</backgroundColor>
		</text>
	</itemDisplay>

	<onUserInput>
		<script>
			ret = "false";
			userInput = currentUserInput();

			if (
				(userInput == "option_red") ||
				(userInput == "pagedown") ||
				(userInput == "pageup") ||
				(userInput == "right") ||
				(userInput == "left") ||
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
				if (userInput == "option_red") {
					/* [紅]更新內容/重覆執行; */
					jumpToLink("refreshItem");
					redrawDisplay();
					ret = "true";
				}
				else if (userInput == "pagedown") {
					idx = itemCount-1;
				}
				else if (userInput == "pageup") {
					idx = 0;
				}
				else if (userInput == "right") {
					idx -= -<?php echo $itemPerPage; ?>;
					if(idx &gt;= itemCount) idx = itemCount-1;
				}
				else if (userInput == "left") {
					idx -= <?php echo $itemPerPage; ?>;
					if(idx &lt; 0) idx = 0;
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

					if ((inputNumCount == 0) || (inputNumCount == itemCountDigits)) {
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

<channel>

<?php
	include('06_get.query.inc');

	$titleComponents = explode('.', $myBaseName);
	$pageTitle = $titleComponents[0];
	if ($cat) {
		$pageTitle = $pageTitle . ': ' . $cat;
	}
	if ($page > 0) {
		$pageTitle = $pageTitle . ' (第 ' . $page . ' 頁)';
	}
?>
	<title><?php echo $pageTitle; ?></title>

<?php
	if($page > 1) {
?>
	<item>
		<?php
			$sThisFile = $_SERVER['SCRIPT_URI'];
			$url = $sThisFile . '?uid=' . $user_id  . '&amp;query=' . ($page-1) . ',';
			if($search) {
				$url = $url . urlencode($search);
			}
			$url = $url . ',';
			if($cat) {
				$url = $url . urlencode($cat);
			}
			$url = $url . ',';
			if($extra) {
				$url = $url . urlencode($extra);
			}
		?>
		<title>上一頁</title>
		<link><?php echo $url;?></link>
		<annotation>上一頁</annotation>
		<image><?php echo $imagePrefix; ?>left.jpg</image>
		<mediaDisplay name="threePartsView" />
	</item>
<?php } ?>

<?php include($myName . '.2.inc'); ?>

<?php
	if($page > 0) {
?>
	<item>
		<?php
			$sThisFile = $_SERVER['SCRIPT_URI'];
			$url = $sThisFile . '?uid=' . $user_id  . '&amp;query=' . ($page+1) . ',';
			if($search) {
				$url = $url . urlencode($search);
			}
			$url = $url . ',';
			if($cat) {
				$url = $url . urlencode($cat);
			}
			$url = $url . ',';
			if($extra) {
				$url = $url . urlencode($extra);
			}
		?>
		<title>下一頁</title>
		<link><?php echo $url;?></link>
		<annotation>下一頁</annotation>
		<image><?php echo $imagePrefix; ?>right.jpg</image>
		<mediaDisplay name="threePartsView" />
	</item>
<?php } ?>

</channel>

<?php
	// refresh this page
	echo "<refreshItem>\r\n";
	echo "\t<link>$currUrl</link>\r\n";
	echo "</refreshItem>\r\n";
?>

</rss>
<?php
	require('00_suffix.php');
?>
