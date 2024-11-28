Import-Module SimplySql
$Server = "test.thegimpboy.com"
$Port = "5432"
$DB = "dtdi"
$outfile = "C:\Users\jbold\Downloads\sql_queries.sql"

Open-PostGreConnection -Server $Server -Database $DB -Port $Port -Credential $cred

$categories = Get-Content -Path ".\categories.json" | ConvertFrom-Json
$categoriesDB = Invoke-SqlQuery -Query "select * from categories"
$statuses = Get-Content -Path ".\statuses.json" | ConvertFrom-Json
$statusesDB = Invoke-SqlQuery -Query "select * from statuses"
$statements = Get-Content -Path ".\data.json" | ConvertFrom-Json
$statementsDB = Invoke-SqlQuery -Query "select * from statements"
#$categoryStatementDB = Invoke-SqlQuery -Query "select * from category_statement"

#$AllQueries = ""
#foreach($category in $categories) {
    # if($categoriesDB.name.Contains($category.name)) {
    #     # "$($category.name) already exists, skipping creation"
    # } else {
        #$AllQueries += "insert into categories (name, fa_icon, color, created_at, updated_at) values ('$($category.name)', '$($category.faIcon)', '$($category.color)', current_timestamp, current_timestamp)\n"
        #Invoke-SqlQuery -Query "insert into categories (name, fa_icon, color, created_at, updated_at) values ('$($category.name)', '$($category.faIcon)', '$($category.color)', current_timestamp, current_timestamp)"
    #}
#}

#foreach($status in $statuses) {
    #if($StatusesDB.name.Contains($status.name)) {
        # "$($status.name) already exists, skipping creation"
    #} else {
        #$AllQueries += "insert into statuses (name, fa_icon, color, created_at, updated_at) values ('$($status.name)', '$($status.faIcon)', '$($status.color)', current_timestamp, current_timestamp)\n"
        #Invoke-SqlQuery -Query "insert into statuses (name, fa_icon, color, created_at, updated_at) values ('$($status.name)', '$($status.faIcon)', '$($status.color)', current_timestamp, current_timestamp)"
    #}
#}

foreach($statement in $statements) {
    # $categoriesDB.Where({$_.name -eq "Economy"})
    $statusID = $statusesDB.Where({$_.name -eq $statement.status.replace("'", "''")}).id

    $URLs = ""
    foreach($url in $statement.sources) {
        $URLs += $url + "\n"
    }

    #$checkStatement = Invoke-SqlQuery -Query "select * from statements where title = '$($statement.title.replace("'", "''").replace('"','\"'))'"
    if($checkStatement.Count -ge 1) {
        #"$($statement.title) already exists, skipping creation"
    } else {
        #Invoke-SqlQuery -Query "insert into statements (title, description, status_id, status_details, user_id, created_at, updated_at, is_public, urls) values ('$($statement.title.replace("'", "''").replace('"','\"'))', '$($statement.description.replace("'", "''"))', $statusID, '$($statement.status_info.replace("'", "''"))', 1, current_timestamp, current_timestamp, true, '$($URLs.replace("'", "''"))');"
    }

    $insertedStatement = Invoke-SqlQuery -Query "select * from statements where title = '$($statement.title.replace("'", "''").replace('"','\"'))'"
    $categoryID = $categoriesDB.Where({$_.name -eq $statement.category})
    
    if($categoryStatementDB.Where({$_.category_id -eq $categoryID.id -and $_.statement_id -eq $insertedStatement.id}).count -le 0 ) {
        "insert into public.`"category_statement`" (category_id, statement_id, created_at, updated_at) values ($($categoryID.id), $($insertedStatement.id), current_timestamp, current_timestamp);"
        #Invoke-SqlQuery -Query "insert into category_statement (category_id, statement_id, created_at, updated_at) values ($($categoryID), $($insertedStatement.id), current_timestamp, current_timestamp);"
    }

    # if($statement.category -is [array]) {
    #     foreach($category in $statement.category) {
    #         $categoryID = $categoriesDB.Where({$_.name -eq $category.name})
    #     }
    # } else {
    #     $categoryID = $categoriesDB.Where({$_.name -eq $statement.category})
    # }
}

Close-SqlConnection
