@extends('layouts.admin')

{{--  @section('sidebar')
     @parent

    <p>This is appended to the master sidebar.</p> 
 @stop
--}}

@section('content')

<div class="row-fluid">
  <div class="span12">
      <!-- Success-Messages -->
      @if ($message = Session::get('success'))
          <div class="alert alert-success alert-block">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <h4>Success</h4>
              <br />
              {{{ $message }}}
          </div>
      @endif
  </div>
</div>

<div class="row-fluid">
  <div class="span12">
<div class="well">
    <div class="btn-group" data-toggle="buttons-checkbox">
        <a class="btn collapse-data-btn" data-toggle="collapse" href="#php-markdown-help">PHP-Markdown Help</a>
    </div>
    <div id="php-markdown-help" class="collapse">
        <p>


          <p><b>This is intended as a quick reference and showcase. For more complete info, see <a href="http://michelf.ca/projects/php-markdown/">PHP Markdown</a>.</b></p>



<p>This document introduce the concepts you need to know when you write using the Markdown syntax.</p>


<ul>
<li><a href="#paragraphs">Paragraphs</a></li>
<li><a href="#emphasis">Emphasis</a></li>
<li><a href="#links">Links</a></li>
<li><a href="#auto-links">Automatic links</a></li>
<li><a href="#headers">Headers</a></li>
<li><a href="#blockquote">Blockquote</a></li>
<li><a href="#lists">Lists</a></li>
<li><a href="#code">Code</a>
  <ul>
    <li><a href="#code-blocks">Code Blocks</a></li>
    <li><a href="#code-spans">Code Spans</a></li>
  </ul>
</li>
<li><a href="#html">HTML</a></li>
</ul>

<hr>

<h2 id="paragraphs">Paragraphs</h2>

<p>A paragraph is defined as one or more lines of text, separated by at least one empty line:</p>

<pre><code>This is a small paragraph illustrating how 
Markdown works. This paragraph span on many 
lines.

This is a second paragraph.
</code></pre>

<p>Here is the result:</p>

<div class="html">
    <p>This is a small paragraph illustrating how 
    Markdown works. This paragraph span on many 
    lines.</p>

    <p>This is a second paragraph.</p>
</div>

<p>Line breaks inserted in the text are removed from the final result: the web browser is in charge of breaking the lines depending of the available space. If you really want to force a line break somewhere, insert <em>two</em> spaces at the end of the line.</p>

<h2 id="emphasis">Emphasis</h2>

<p>You can put emphasis some part of your text inside a paragraph. There is two types of emphasis: normal emphasis and strong emphasis. On most websites, emphasis is shown as italic while strong emphasis is bold.</p>

<p>To give emphasis to some text with Markdown, we use asterisks (<code>*</code>) or underscores (<code>_</code>). Surrounding some text with one asterisk or one underscore bar gives normal emphasis, while surrounding some text with two asterisks or two underscores results in strong emphasis:</p>

<pre><code>*normal emphasis with asterisks*

_normal emphasis with underscore_

**strong emphasis with asterisks**

__strong emphasis with underscore__

This is some text *emphased* with asterisks.
</code></pre>

<p>And it gives this result:</p>

<div class="html">

<p><em>normal emphasis with asterisks</em></p>

<p><em>normal emphasis with underscore</em></p>

<p><strong>strong emphasis with asterisks</strong></p>

<p><strong>strong emphasis with underscore</strong></p>

<p>This is some text <em>emphased</em> with asterisks.</p>

</div>

<p>Please note that there is absolutely no difference between using underscore and asterisks: both give exactly the same result. Choose the one you are the most comfortable with.</p>

<h2 id="links">Links</h2>

<p>If you want to insert an hypertext link inside your document, Markdown gives you two ways. You can write your links <em>inline</em> links or <em>by reference</em>.</p>

<p><strong>Inline-style links</strong> allow linking some text to another web page. Surround the link with [brackets], followed by the URL inside parenthesis. Like this</p>

<pre><code>[Michel Fortin](http://michelf.ca/)

[Michel Fortin](http://michelf.ca/ "My website")
</code></pre>

<div class="html">

<p><a href="http://michelf.ca/">Michel Fortin</a></p>

<p><a href="http://michelf.ca/" title="My website">Michel Fortin</a></p>

</div>

<p>The second link has a title (quoted) which is displayed by most web browser as a tooltip when your mouse stops over the link. The title is optional.</p>

<p><strong>Refence-style links</strong> work the same, except that you do not have to write the URL in the middle of the paragraph, which makes text more legible. Instead you give a name to the link and you write the URL on a separate line — anywhere in the document. It looks like this:</p>

<pre><code>This is a small text written by [Michel Fortin][mf].

 [mf]: http://michelf.ca/ "My website"
</code></pre>

<p>The line that define the URL is stripped from the final result and the bracketed text becomes a link:</p>

<div class="html">

<p>This is a small text written by <a href="http://michelf.ca/" title="My website">Michel Fortin</a>.</p>

</div>

<p>Again, the title of the link (My website) is optional.</p>

<h3 id="auto-links">Automatic links</h3>

<p>If you simply want to be able to click at an URL inserted in your text, put the URL between angle brackets and Markdown will make a clickable link with it:</p>

<pre><code>&lt;http://michelf.ca/&gt;

&lt;michel.fortin@michelf.ca&gt;
</code></pre>

<div class="html">

<p><a href="http://michelf.ca/">http://michelf.ca/</a></p>

<p><a href="mailto:michel.fortin@michelf.ca">michel.fortin@michelf.ca</a></p>

</div>

<h2 id="headers">Headers</h2>

<p>You can add headers and sub-headers to your document with Markdown. Two syntaxes allow you to insert headers with up to six different levels. You can write headers of level 1 and 2 using the “SeText” syntax:</p>

<pre><code>Header 1
========

Header 2
--------
</code></pre>

<div class="html">

<h1>Header 1</h1>

<h2>Header 2</h2>

</div>

<p>The “atx” syntax can create headers of any level by changing the number of hash (<code>#</code>):</p>

<pre><code># Header 1 #

## Header 2 ##

###### Header at level 6
</code></pre>

<div class="html">

<h1>Header 1</h1>

<h2>Header 2</h2>

<h6>Header at level 6</h6>

</div>

<p>Note that the tailing hashes are optional.</p>

<h2 id="blockquote">Blockquote</h2>

<p>Maybe you already seen this way of quoting someone in an email discussion:</p>

<pre><code>A quote about linear algebra:

&gt; Consistent linear systems in real life are solved in 
&gt; one of two ways: by direct calculation (using a matrix 
&gt; factorization, for example) or by an iterative procedure 
&gt; that generates a sequence of vectors that approach the 
&gt; exact solution.
</code></pre>

<div class="html">

<p>A quote about linear algebra:</p>

<blockquote>
  <p>Consistent linear systems in real life are solved in 
  one of two ways: by direct calculation (using a matrix 
  factorization, for example) or by an iterative procedure 
  that generates a sequence of vectors that approach the 
  exact solution.</p>
</blockquote>

</div>

<p>You can put more than one paragraph inside a blockquote. You can also put a second blockquote level, lists, etc.</p>

<h2 id="lists">Lists</h2>

<p>Markdown assists you when creating numbered lists (ordered) and bullet lists (unordored). To create and ordered list, use a number followed by a dot as the item marker:</p>

<pre><code>1.  Snowy
2.  Elf
3.  Boreal
</code></pre>

<div class="html">

<ol>
<li>Snowy</li>
<li>Elf</li>
<li>Boreal</li>
</ol>

</div>

<p>To create an unordered list, use <code>*</code>, <code>+</code>, or <code>-</code> as item marker:</p>

<pre><code>*   Sun
*   Moon
*   Earth
</code></pre>

<div class="html">

<ul>
<li>Sun</li>
<li>Moon</li>
<li>Earth</li>
</ul>

</div>

<p>You can nest lists by indenting by four spaces (or one tab) the lists on the second level:</p>

<pre><code>*   Ingredients
    -   Milk
    -   Eggs
*   Recipies
    1.  Pancake
    2.  Waffle
</code></pre>

<div class="html">

<ul>
<li>Ingredients

<ul>
<li>Milk</li>
<li>Eggs</li>
</ul></li>
<li>Recipies

<ol>
<li>Pancake</li>
<li>Waffle</li>
</ol></li>
</ul>

</div>

<p>If your list contains entire paragraphs, leave an empty line between list items. To write more than one paragraph under the same item, make sure that they are indented by 4 spaces (or one tab):</p>

<pre><code>1.  First paragraph.

    Second paragraph.

2.  Another list item.

3.  Yet another.
</code></pre>

<div class="html">

<ol>
<li><p>First paragraph.</p>

<p>Second paragraph.</p></li>
<li><p>Another list item.</p></li>
<li><p>Yet another.</p></li>
</ol>

</div>

<h2 id="code">Code</h2>

<h3 id="code-blocks">Code Blocks</h3>

<p>We write a code block by indenting some lines by four spaces (or one tab):</p>

<pre><code>How to mark emphasis:

    Using &lt;em&gt;HTML&lt;/em&gt; and using *Markdown*.
</code></pre>

<p>Inside a code block, you can write HTML tags or Markdown formatting; in both cases the syntax won’t be parsed and text will be shown as is:</p>

<div class="html">

<p>How to mark emphasis:</p>

<pre><code>Using &lt;em&gt;HTML&lt;/em&gt; and using *Markdown*.
</code></pre>

</div>

<h3 id="code-spans">Code Spans</h3>

<p>You can make a code span in the middle of your paragraph by using the backtick (<code>`</code>), this way:</p>

<pre><code>Please don't use the `&lt;blink&gt;` tag.
</code></pre>

<p>Which will produce the following result:</p>

<div class="html">

<p>Please don’t use the <code>&lt;blink&gt;</code> tag.</p>

</div>

<h2 id="html">HTML</h2>

<p>You don’t have to know HTML in order to use Markdown. But if you know some HTML tags, you can use them where you want. For example, to format some text as superscript — something not covered by the Markdown syntax — you can use the <code>&lt;sup&gt;</code> HTML tag:</p>

<pre><code>Be cautious about what you read on April 1&lt;sup&gt;st&lt;/sup&gt;!
</code></pre>

<p>Markdown will skip the tag without changing it and the browser will display text inside as superscript:</p>

<div class="html">
<p>Be cautious about what you read on April 1<sup>st</sup>!</p>
</div>

<p>Some tags like <code>&lt;p&gt;</code> and <code>&lt;div&gt;</code> delimits text blocks. If you use these tags, special rules apply. See the <a href="http://daringfireball.net/projects/markdown/syntax#html">Inline HTML</a> section from the syntax desciption to learn about them.</p>








        </p>
    </div>
</div>

<div class="well">
    <div class="btn-group" data-toggle="buttons-checkbox">
        <a class="btn collapse-data-btn" data-toggle="collapse" href="#php-markdown-extra-help">PHP-Markdown Extra Help</a>
    </div>
    <div id="php-markdown-extra-help" class="collapse">
        <p>


<p>PHP Markdown Extra is a PHP Markdown extension implementing some features currently not available with the plain Markdown syntax. PHP Markdown Extra is available as a separate parser class in <a href="/projects/php-markdown/">PHP Markdown Lib</a>.</p>

<p>This document explains the changes and additions to the <a href="http://daringfireball.net/projects/markdown/syntax">Markdown syntax</a> implemented by PHP Markdown Extra. You should already be familiar with original Markdown syntax documentation before reading this document.</p>

<ul>
<li><a href="#inline-html">Inline HTML</a></li>
<li><a href="#markdown-attr">Markdown Inside HTML Blocks</a></li>
<li><a href="#spe-attr">Special Attributes</a></li>
<li><a href="#fenced-code-blocks">Fenced Code Blocks</a></li>
<li><a href="#table">Tables</a></li>
<li><a href="#def-list">Definition Lists</a></li>
<li><a href="#footnotes">Footnotes</a>

<ul>
<li><a href="#fn-output">Output</a></li>
</ul></li>
<li><a href="#abbr">Abbreviations</a></li>
<li><a href="#em">Emphasis</a></li>
<li><a href="#backslash">Backslash Escapes</a></li>
</ul>

<hr>

<h2 id="inline-html">Inline HTML</h2>

<p>With Markdown, you can insert HTML right in the middle of your text. This is pretty useful when you need some features not provided by the Markdown syntax but which are easy to do with HTML.</p>

<p>But Markdown has a serious limitation when it comes to block elements. From the Markdown syntax documentation:</p>

<blockquote>
  <p>Block-level HTML elements ” e.g. <code>&lt;div&gt;</code>, <code>&lt;table&gt;</code>, <code>&lt;pre&gt;</code>, <code>&lt;p&gt;</code>, 
  etc. ” must be separated from surrounding content by blank lines, and the 
  start and end tags of the block should not be indented with tabs or spaces.</p>
</blockquote>

<p>These restrictions have been lifted in PHP Markdown Extra, and replaced by these less restrictive two:</p>

<ol>
<li><p>The opening tag of a block element must not be indented by more 
than three spaces. Any tag indented more than that will be treated
as a code block according to standard Markdown rules.</p></li>
<li><p>When the block element is found inside a list, all its content should 
be indented with the same amount of space as the list item is indented. 
(More indentation won’t do any harm as long as the first opening 
tag is not indented too much and then become a code block — see first rule.)</p></li>
</ol>

<h2 id="markdown-attr">Markdown Inside HTML Blocks</h2>

<p>Previously in Markdown, you couldn’t wrap Markdown-formatted content inside a <code>&lt;div&gt;</code> element. This is because <code>&lt;div&gt;</code> is a block element and plain Markdown does not format the content of such.</p>

<p>PHP Markdown Extra gives you a way to put Markdown-formatted text inside any block-level tag. You do this by adding a <code>markdown</code> attribute to the tag with the value <code>1</code> — which gives <code>markdown="1"</code> — like this:</p>

<pre><code>&lt;div markdown="1"&gt;
This is *true* markdown text.
&lt;/div&gt;
</code></pre>

<p>The <code>markdown="1"</code> attribute will be stripped and <code>&lt;div&gt;</code>’s content will be converted from Markdown to HTML. The end result will look like this:</p>

<pre><code>&lt;div&gt;

&lt;p&gt;This is &lt;em&gt;true&lt;/em&gt; markdown text.&lt;/p&gt;

&lt;/div&gt;
</code></pre>

<p>PHP Markdown Extra is smart enough to apply the correct formatting depending on the block element you put the <code>markdown</code> attribute on. If you apply the <code>markdown</code> attribute to a <code>&lt;p&gt;</code> tag for instance, it will only produce span-level elements inside — it won’t allow lists, blockquotes, code blocks.</p>

<p>But these are some cases where this is ambiguous, like this one for instance:</p>

<pre><code>&lt;table&gt;
&lt;tr&gt;
&lt;td markdown="1"&gt;This is *true* markdown text.&lt;/td&gt;
&lt;/tr&gt;
&lt;/table&gt;
</code></pre>

<p>A table cell can contain both span and block elements. In cases like this one, PHP Markdown Extra will only apply span-level rules. If you wish to enable block constructs, simply write <code>markdown="block"</code> instead.</p>

<h2 id="spe-attr"><span id="header-id">Special Attributes</span></h2>

<p>With PHP Markdown Extra, you can set the id and class attribute on certain elements using an attribute block. For instance, put the desired id prefixed by a hash inside curly brackets after the header at the end of the line, like this:</p>

<pre><code>Header 1            {#header1}
========

## Header 2 ##      {#header2}
</code></pre>

<p>Then you can create links to different parts of the same document like this:</p>

<pre><code>[Link back to header 1](#header1)
</code></pre>

<p>To add a class name, which can be used as a hook for a style sheet, use a dot like this:</p>

<pre><code>## The Site ##    {.main}
</code></pre>

<p>The id and multiple class names can be combined by putting them all into the same special attribute block:</p>

<pre><code>## The Site ##    {.main .shine #the-site}
</code></pre>

<p>At this time, special attribute blocks can be used with</p>

<ul>
<li>headers,</li>
<li>fenced code blocks,</li>
<li>links, and</li>
<li>images.</li>
</ul>

<p>For image and links, put the special attribute block immediately after the parenthesis containing the address:</p>

<pre><code>[link](url){#id .class}  
![img](url){#id .class}
</code></pre>

<p>Or if using reference-style links and images, put it at the end of the definition line like this:</p>

<pre><code>[link][linkref] or [linkref]  
![img][linkref]

[linkref]: url "optional title" {#id .class}
</code></pre>

<h2 id="fenced-code-blocks">Fenced Code Blocks</h2>

<p>Version 1.2 of PHP Markdown Extra introduced a syntax code block without indentation. Fenced code blocks are like Markdown’s regular code blocks, except that they’re not indented and instead rely on a start and end fence lines to delimit the code block. The code block start with a line containing three or more tilde <code>~</code> characters, and ends with the first line with the same number of tilde <code>~</code>. For instance:</p>

<pre><code>This is a paragraph introducing:

~~~~~~~~~~~~~~~~~~~~~
a one-line code block
~~~~~~~~~~~~~~~~~~~~~
</code></pre>

<p>Contrary to their indented counterparts, fenced code blocks can begin and end with blank lines:</p>

<pre><code>~~~

blank line before
blank line after

~~~
</code></pre>

<p>Indented code blocks cannot be used immediately following a list because the list indent takes precedence; fenced code block have no such limitation:</p>

<pre><code>1.  List item

    Not an indented code block, but a second paragraph
    in the list item

~~~~
This is a code block, fenced-style
~~~~
</code></pre>

<p>Fenced code blocks are also ideal if you need to paste some code in an editor which doesn’t have a command for increasing the indent of a block of text, such as a text box in your web browser.</p>

<p>You can specify a class name that will apply to a code block. This is useful
if you want to style differently code blocks depending on the language. Or
you could also use it to tell a syntax highlighter what syntax to use.</p>

<pre><code>~~~~~~~~~~~~~~~~~~~~~~~~~~~~ .html
&lt;p&gt;paragraph &lt;b&gt;emphasis&lt;/b&gt;
~~~~~~~~~~~~~~~~~~~~~~~~~~~~
</code></pre>

<p>The class name is placed at the end of the first fence. It can be
preceded by a dot, but this is not a requirement. You can also use a special attribute block:</p>

<pre><code>~~~~~~~~~~~~~~~~~~~~~~~~~~~~ {.html #example-1}
&lt;p&gt;paragraph &lt;b&gt;emphasis&lt;/b&gt;
~~~~~~~~~~~~~~~~~~~~~~~~~~~~
</code></pre>

<p>In the HTML output, code block attributes will be applied on the <code>code</code> element; if you want to see them on the <code>pre</code> element instead, set the configuration variable <code>code_attr_on_pre</code> on the parser to <code>true</code>. See the <a href="../configuration/">configuration</a> reference for more details.</p>

<h2 id="table">Tables</h2>

<p>PHP Markdown Extra has its own syntax for simple tables. A “simple” table looks like this:</p>

<pre><code>First Header  | Second Header
------------- | -------------
Content Cell  | Content Cell
Content Cell  | Content Cell
</code></pre>

<p>First line contains column headers; second line contains a mandatory separator line between the headers and the content; each following line is a row in the table. Columns are always separated by the pipe (<code>|</code>) character. Once converted to HTML, the result is like this:</p>

<pre><code>&lt;table&gt;
&lt;thead&gt;
&lt;tr&gt;
  &lt;th&gt;First Header&lt;/th&gt;
  &lt;th&gt;Second Header&lt;/th&gt;
&lt;/tr&gt;
&lt;/thead&gt;
&lt;tbody&gt;
&lt;tr&gt;
  &lt;td&gt;Content Cell&lt;/td&gt;
  &lt;td&gt;Content Cell&lt;/td&gt;
&lt;/tr&gt;
&lt;tr&gt;
  &lt;td&gt;Content Cell&lt;/td&gt;
  &lt;td&gt;Content Cell&lt;/td&gt;
&lt;/tr&gt;
&lt;/tbody&gt;
&lt;/table&gt;
</code></pre>

<p>If you wish, you can add a leading and tailing pipe to each line of the table. Use the form that you like. As an illustration, this will give the same result as above:</p>

<pre><code>| First Header  | Second Header |
| ------------- | ------------- |
| Content Cell  | Content Cell  |
| Content Cell  | Content Cell  |
</code></pre>

<p>Note: A table need <em>at least</em> one pipe on each line for PHP Markdown Extra to parse it correctly. This means that the only way to create a one-column table is to add a leading or a tailing pipe, or both of them, to each line.</p>

<p>You can specify alignment for each column by adding colons to separator lines. A colon at the left of the separator line will make the column left-aligned; a colon on the right of the line will make the column right-aligned; colons at both side means the column is center-aligned.</p>

<pre><code>| Item      | Value |
| --------- | -----:|
| Computer  | $1600 |
| Phone     |   $12 |
| Pipe      |    $1 |
</code></pre>

<p>The <code>align</code> HTML attribute is applied to each cell of the concerned column.</p>

<p>You can apply span-level formatting to the content of each cell using regular Markdown syntax:</p>

<pre><code>| Function name | Description                    |
| ------------- | ------------------------------ |
| `help()`      | Display the help window.       |
| `destroy()`   | **Destroy your computer!**     |
</code></pre>

<h2 id="def-list">Definition Lists</h2>

<p>PHP Markdown Extra implements definition lists. Definition lists are made of terms and definitions of these terms, much like in a dictionary.</p>

<p>A simple definition list in PHP Markdown Extra is made of a single-line term followed by a colon and the definition for that term.</p>

<pre><code>Apple
:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
</code></pre>

<p>Terms must be separated from the previous definition by a blank line. Definitions can span on multiple lines, in which case they should be indented. But you don’t really have to: if you want to be lazy, you could forget to indent a definition that span on multiple lines and it will still work:</p>

<pre><code>Apple
:   Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
</code></pre>

<p>Each of the preceding definition lists will give the same HTML result:</p>

<pre><code>&lt;dl&gt;
&lt;dt&gt;Apple&lt;/dt&gt;
&lt;dd&gt;Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.&lt;/dd&gt;

&lt;dt&gt;Orange&lt;/dt&gt;
&lt;dd&gt;The fruit of an evergreen tree of the genus Citrus.&lt;/dd&gt;
&lt;/dl&gt;
</code></pre>

<p>Colons as definition markers typically start at the left margin, but may be indented by up to three spaces. Definition markers must be followed by one or more spaces or a tab.</p>

<p>Definition lists can have more than one definition associated with one term:</p>

<pre><code>Apple
:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.
:   An American computer company.

Orange
:   The fruit of an evergreen tree of the genus Citrus.
</code></pre>

<p>You can also associate more than one term to a definition:</p>

<pre><code>Term 1
Term 2
:   Definition a

Term 3
:   Definition b
</code></pre>

<p>If a definition is preceded by a blank line, PHP Markdown Extra will wrap the definition in <code>&lt;p&gt;</code> tags in the HTML output. For example, this:</p>

<pre><code>Apple

:   Pomaceous fruit of plants of the genus Malus in 
    the family Rosaceae.

Orange

:    The fruit of an evergreen tree of the genus Citrus.
</code></pre>

<p>will turn into this:</p>

<pre><code>&lt;dl&gt;
&lt;dt&gt;Apple&lt;/dt&gt;
&lt;dd&gt;
&lt;p&gt;Pomaceous fruit of plants of the genus Malus in 
the family Rosaceae.&lt;/p&gt;
&lt;/dd&gt;

&lt;dt&gt;Orange&lt;/dt&gt;
&lt;dd&gt;
&lt;p&gt;The fruit of an evergreen tree of the genus Citrus.&lt;/p&gt;
&lt;/dd&gt;
&lt;/dl&gt;
</code></pre>

<p>And just like regular list items, definitions can contain multiple paragraphs, and include other block-level elements such as blockquotes, code blocks, lists, and even other definition lists.</p>

<pre><code>Term 1

:   This is a definition with two paragraphs. Lorem ipsum 
    dolor sit amet, consectetuer adipiscing elit. Aliquam 
    hendrerit mi posuere lectus.

    Vestibulum enim wisi, viverra nec, fringilla in, laoreet
    vitae, risus.

:   Second definition for term 1, also wrapped in a paragraph
    because of the blank line preceding it.

Term 2

:   This definition has a code block, a blockquote and a list.

        code block.

    &gt; block quote
    &gt; on two lines.

    1.  first list item
    2.  second list item
</code></pre>

<h2 id="footnotes">Footnotes</h2>

<p>Footnotes work mostly like reference-style links. A footnote is made of two things: a marker in the text that will become a superscript number; a footnote definition  that will be placed in a list of footnotes at the end of the document. A footnote looks like this:</p>

<pre><code>That's some text with a footnote.[^1]

[^1]: And that's the footnote.
</code></pre>

<p>Footnote definitions can be found anywhere in the document, but footnotes will always be listed in the order they are linked to in the text. Note that you cannot make two links to the same footnotes: if you try, the second footnote reference will be left as plain text.</p>

<p>Each footnote must have a distinct name. That name will be used to link footnote references to footnote definitions, but has no effect on the numbering of the footnotes. Names can contain any character valid within an <code>id</code> attribute in HTML.</p>

<p>Footnotes can contain block-level elements, which means that you can put multiple paragraphs, lists, blockquotes and so on in a footnote. It works the same as for list items: just indent the following paragraphs by four spaces in the footnote definition:</p>

<pre><code>That's some text with a footnote.[^1]

[^1]: And that's the footnote.

    That's the second paragraph.
</code></pre>

<p>If you want things to align better, you can leave the first line of the footnote empty and put your first paragraph just below:</p>

<pre><code>[^1]:
    And that's the footnote.

    That's the second paragraph.
</code></pre>

<h3 id="fn-output">Output</h3>

<p>It’s probably true that a single footnote markup cannot satisfy everyone. A future version may provide a programming interface to allow different markup to be generated. But for today, the output follows <a href="http://daringfireball.net/2005/07/footnotes">what can be seen on Daring Fireball</a>, with slight modifications. Here is the default output from the first sample above:</p>

<pre><code>&lt;p&gt;That's some text with a footnote.
   &lt;sup id="fnref-1"&gt;&lt;a href="#fn-1" class="footnote-ref"&gt;1&lt;/a&gt;&lt;/sup&gt;&lt;/p&gt;

&lt;div class="footnotes"&gt;
&lt;hr /&gt;
&lt;ol&gt;

&lt;li id="fn-1"&gt;
&lt;p&gt;And that's the footnote.
   &lt;a href="#fnref-1" class="footnote-backref"&gt;&amp;#8617;&lt;/a&gt;&lt;/p&gt;
&lt;/li&gt;

&lt;/ol&gt;
&lt;/div&gt;
</code></pre>

<p>A little cryptic, but in a browser it will look like this:</p>


<div class="html" style="border:1px dotted">
    <p>That’s some text with a footnote.<sup id="fnref-1"><a href="#fn-1" class="footnote-ref">1</a></sup></p>

    <div class="footnotes">
    <hr style="border-top: 1px dotted black">
    <ol>

    <li id="fn-1">
    <p>And that’s the footnote.
       <a href="#fnref-1" class="footnote-backref">↩</a></p>
    </li>

    </ol>
    </div>
</div>
<p>&nbsp;</p>
<p>The <code>class="footnote-ref"</code> and <code>class="footnote-backref"&gt;</code> attributes on the links express the relation they have with the elements they link to. They can be used to style the elements with CSS rules such as:</p>

<pre><code>a.footnote-ref { ... }
a.footnote-backref { ... }
</code></pre>

<p>You can customize the <code>class</code> and <code>title</code> attributes for footnote links and backlinks. See the <a href="../configuration/">configuration</a> reference for more details.</p>

<h2 id="abbr">Abbreviations</h2>

<p>PHP Markdown Extra adds supports for abbreviations (HTML tag <code>&lt;abbr&gt;</code>). How it works is pretty simple: create an abbreviation definition like this:</p>

<pre><code>*[HTML]: Hyper Text Markup Language
*[W3C]:  World Wide Web Consortium
</code></pre>

<p>then, elsewhere in the document, write text such as:</p>

<pre><code>The HTML specification
is maintained by the W3C.
</code></pre>

<p>and any instance of those words in the text will become:</p>

<pre><code>The &lt;abbr title="Hyper Text Markup Language"&gt;HTML&lt;/abbr&gt; specification
is maintained by the &lt;abbr title="World Wide Web Consortium"&gt;W3C&lt;/abbr&gt;.
</code></pre>

<p>Abbreviations are case-sensitive, and will span on multiple words when defined as such. An abbreviation may also have an empty definition, in which case <code>&lt;abbr&gt;</code> tags will be added in the text but the <code>title</code> attribute will be omitted.</p>

<pre><code>Operation Tigra Genesis is going well.

*[Tigra Genesis]:
</code></pre>

<p>Abbreviation definitions can be anywhere in the document. They are stripped from the final document.</p>

<h2 id="em">Emphasis</h2>

<p>Rules for emphasis have slightly changed from the original Markdown syntax. With PHP Markdown Extra, underscores in the middle of a word are now treated as literal characters. Underscore emphasis only works for whole words. If you need to emphasize only some part of a word, it is still possible by using asterisks as emphasis markers.</p>

<p>For example, with this:</p>

<pre><code>Please open the folder "secret_magic_box".
</code></pre>

<p>PHP Markdown Extra won’t convert underscores to emphasis because they are in the middle of the word. The HTML result from PHP Markdown Extra looks like this:</p>

<pre><code>&lt;p&gt;Please open the folder "secret_magic_box".&lt;/p&gt;
</code></pre>

<p>Emphasis with underscore still works as long as you emphasize whole words like this:</p>

<pre><code>I like it when you say _you love me_.
</code></pre>

<p>The same apply for strong emphasis: with PHP Markdown Extra, you can no longer set strong emphasis in the middle of a word using underscores, you must do so using asterisks as emphasis markers.</p>

<h2 id="backslash">Backslash Escapes</h2>

<p>PHP Markdown Extra adds the colon (<code>:</code>) and the pipe (<code>|</code>) to the list of characters you can escape using a backslash. With this you can prevent them from triggering a definition list or a table.</p>



        </p>
    </div>
</div>



<div class="well">
    <div class="btn-group" data-toggle="buttons-checkbox">
        <a class="btn collapse-data-btn" data-toggle="collapse" href="#search-help">Advanced Search Help</a>
    </div>
    <div id="search-help" class="collapse">
        <p>



<p><b>This is intended as a quick reference and showcase. For more complete info, see <a href="http://dev.mysql.com/doc/refman/5.0/en/fulltext-boolean.html">Boolean Full-Text Searches</a>.</b></p>


    <p>
    The following examples demonstrate some search strings that use
            boolean full-text operators:
    </p>
    <div class="itemizedlist">
    <ul class="itemizedlist" style="list-style-type: disc; "><li class="listitem"><p>
            <code class="literal">'apple banana'</code>
          </p><p>
            Find rows that contain at least one of the two words.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple +juice'</code>
          </p><p>
            Find rows that contain both words.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple macintosh'</code>
          </p><p>
            Find rows that contain the word <span class="quote">“<span class="quote">apple</span>”</span>, but
            rank rows higher if they also contain
            <span class="quote">“<span class="quote">macintosh</span>”</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple -macintosh'</code>
          </p><p>
            Find rows that contain the word <span class="quote">“<span class="quote">apple</span>”</span> but not
            <span class="quote">“<span class="quote">macintosh</span>”</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple ~macintosh'</code>
          </p><p>
            Find rows that contain the word <span class="quote">“<span class="quote">apple</span>”</span>, but if
            the row also contains the word <span class="quote">“<span class="quote">macintosh</span>”</span>,
            rate it lower than if row does not. This is
            <span class="quote">“<span class="quote">softer</span>”</span> than a search for <code class="literal">'+apple
            -macintosh'</code>, for which the presence of
            <span class="quote">“<span class="quote">macintosh</span>”</span> causes the row not to be returned
            at all.
          </p></li><li class="listitem"><p>
            <code class="literal">'+apple +(&gt;turnover &lt;strudel)'</code>
          </p><p>
            Find rows that contain the words <span class="quote">“<span class="quote">apple</span>”</span> and
            <span class="quote">“<span class="quote">turnover</span>”</span>, or <span class="quote">“<span class="quote">apple</span>”</span> and
            <span class="quote">“<span class="quote">strudel</span>”</span> (in any order), but rank <span class="quote">“<span class="quote">apple
            turnover</span>”</span> higher than <span class="quote">“<span class="quote">apple strudel</span>”</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'apple*'</code>
          </p><p>
            Find rows that contain words such as <span class="quote">“<span class="quote">apple</span>”</span>,
            <span class="quote">“<span class="quote">apples</span>”</span>, <span class="quote">“<span class="quote">applesauce</span>”</span>, or
            <span class="quote">“<span class="quote">applet</span>”</span>.
          </p></li><li class="listitem"><p>
            <code class="literal">'"some words"'</code>
          </p><p>
            Find rows that contain the exact phrase <span class="quote">“<span class="quote">some
            words</span>”</span> (for example, rows that contain <span class="quote">“<span class="quote">some
            words of wisdom</span>”</span> but not <span class="quote">“<span class="quote">some noise
            words</span>”</span>). Note that the
            <span class="quote">“<span class="quote"><code class="literal">"</code></span>”</span> characters that enclose
            the phrase are operator characters that delimit the phrase.
            They are not the quotation marks that enclose the search
            string itself.
    </p>

    </li></ul>
    </div>









        </p>
    </div>
</div>

 </div>
</div>
@stop


