thod and Description</th>
</tr>
<tr class="altColor">
<td class="colFirst"><code><a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a></code></td>
<td class="colLast"><code><strong><a href="../../../../../org/gradle/plugins/ear/descriptor/EarModule.html#getAltDeployDescriptor()">getAltDeployDescriptor</a></strong>()</code>
<div class="block">The alt-dd element specifies an optional URI to the post-assembly version of the deployment descriptor file for a
 particular Java EE module.</div>
</td>
</tr>
<tr class="rowColor">
<td class="colFirst"><code><a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a></code></td>
<td class="colLast"><code><strong><a href="../../../../../org/gradle/plugins/ear/descriptor/EarModule.html#getPath()">getPath</a></strong>()</code>
<div class="block">The connector element specifies the URI of an archive file, relative to the top level of the application package.</div>
</td>
</tr>
<tr class="altColor">
<td class="colFirst"><code>void</code></td>
<td class="colLast"><code><strong><a href="../../../../../org/gradle/plugins/ear/descriptor/EarModule.html#setAltDeployDescriptor(java.lang.String)">setAltDeployDescriptor</a></strong>(<a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a>&nbsp;altDeployDescriptor)</code>&nbsp;</td>
</tr>
<tr class="rowColor">
<td class="colFirst"><code>void</code></td>
<td class="colLast"><code><strong><a href="../../../../../org/gradle/plugins/ear/descriptor/EarModule.html#setPath(java.lang.String)">setPath</a></strong>(<a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a>&nbsp;path)</code>&nbsp;</td>
</tr>
<tr class="altColor">
<td class="colFirst"><code><a href="http://docs.groovy-lang.org/docs/groovy-2.4.12/html/gapi/groovy/util/Node.html?is-external=true" title="class or interface in groovy.util">Node</a></code></td>
<td class="colLast"><code><strong><a href="../../../../../org/gradle/plugins/ear/descriptor/EarModule.html#toXmlNode(groovy.util.Node,%20java.lang.Object)">toXmlNode</a></strong>(<a href="http://docs.groovy-lang.org/docs/groovy-2.4.12/html/gapi/groovy/util/Node.html?is-external=true" title="class or interface in groovy.util">Node</a>&nbsp;parentModule,
         <a href="https://docs.oracle.com/javase/7/docs/api/java/lang/Object.html?is-external=true" title="class or interface in java.lang">Object</a>&nbsp;name)</code>
<div class="block">Convert this object to an XML Node (or two nodes if altDeployDescriptor is not null).</div>
</td>
</tr>
</table>
</li>
</ul>
</li>
</ul>
</div>
<div class="details">
<ul class="blockList">
<li class="blockList">
<!-- ============ METHOD DETAIL ========== -->
<ul class="blockList">
<li class="blockList"><a name="method_detail">
<!--   -->
</a>
<h3>Method Detail</h3>
<a name="getPath()">
<!--   -->
</a>
<ul class="blockList">
<li class="blockList">
<h4>getPath</h4>
<pre><a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a>&nbsp;getPath()</pre>
<div class="block">The connector element specifies the URI of an archive file, relative to the top level of the application package.</div>
</li>
</ul>
<a name="setPath(java.lang.String)">
<!--   -->
</a>
<ul class="blockList">
<li class="blockList">
<h4>setPath</h4>
<pre>void&nbsp;setPath(<a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a>&nbsp;path)</pre>
</li>
</ul>
<a name="getAltDeployDescriptor()">
<!--   -->
</a>
<ul class="blockList">
<li class="blockList">
<h4>getAltDeployDescriptor</h4>
<pre><a href="https://docs.oracle.com/javase/7/docs/api/java/lang/String.html?is-external=true" title="class or interface in java.lang">String</a>&nbsp;getAltDeployDescriptor()</pre>
<div class="block">The alt-dd element specifies an optional URI to the post-assembly version of the deployme