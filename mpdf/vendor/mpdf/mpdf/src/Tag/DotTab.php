﻿<VSTemplate Version="3.0.0" xmlns="http://schemas.microsoft.com/developer/vstemplate/2005" Type="Item">
    <TemplateData>
        <Name Package="{B54016DB-B3E6-4960-8262-81772C777DE9}" ID="21126"/>
        <Description Package="{B54016DB-B3E6-4960-8262-81772C777DE9}" ID="21127"/>
        <Icon Package="{39c9c826-8ef8-4079-8c95-428f5b1c323f}" ID="4703"/>
        <ProjectType>CSharp</ProjectType>
        <ProjectSubType>Web</ProjectSubType>
        <TemplateGroupID>Web</TemplateGroupID>
        <SortOrder>55</SortOrder>
        <DefaultName>MyHub.cs</DefaultName>
        <ProvideDefaultName>true</ProvideDefaultName>
        <RequiredFrameworkVersion>4.5</RequiredFrameworkVersion>
        <TemplateID>SignalRHubItemTemplates.WAP.12.cs.vstemplate.v5</TemplateID>
        <ShowByDefault>false</ShowByDefault>
        <NumberOfParentCategoriesToRollUp>1</NumberOfParentCategoriesToRollUp>
    </TemplateData>
    <TemplateContent>
        <References />
        <ProjectItem SubType="" TargetFileName="$fileinputname$.cs" ReplaceParameters="true">MyHub.cs</ProjectItem>
    </TemplateContent>
    <WizardExtension>
        <Assembly>NuGet.VisualStudio.Interop, Version=1.0.0.0, Culture=neutral, PublicKeyToken=b03f5f7f11d50a3a</Assembly>
        <FullClassName>NuGet.VisualStudio.TemplateWizard</FullClassName>
    </WizardExtension>
    <WizardData>
        <packages repository="registry" keyName="WebStackVS15" isPreunzipped="true">
            <package id="Newtonsoft.Json" version="11.0.1" />
            <package id="jQuery" version="3.3.1" />
            <package id="Owin" version="1.0" />
            <package id="Microsoft.Web.Infrastructure" version="1.0.0.0" />
            <package id="Microsoft.Owin" version="4.0.0" />
            <package id="Microsoft.Owin.Security" version="4.0.0" />
            <package id="Microsoft.Owin.Host.SystemWeb" version="4.0.0" />
            <package id="Microsoft.AspNet.SignalR.Core" version="2.2.2" />
            <package id="Microsoft.AspNet.SignalR.JS" version="2.2.2" />
            <package id="Microsoft.AspNet.SignalR.SystemWeb" version="2.2.2" />
            <package id="Microsoft.AspNet.SignalR" version="2.2.2" />
            
        <